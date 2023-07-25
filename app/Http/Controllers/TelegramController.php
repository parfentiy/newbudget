<?php

namespace App\Http\Controllers;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class TelegramController extends Controller
{
    public function getMe() {
        $response = Telegram::bot('mybot')->getMe();
        Log::info($response);
        return;
    }

    public function send() {
        $response = Telegram::sendMessage([
            'chat_id' => '247164112',
            'text' => 'Hello World'
        ]);

        $messageId = $response->getMessageId();
        Log::info($messageId);
    }

    public function getFromBot() {
        $updates = Telegram::getWebhookUpdate();
        Log::info($updates);
        if (isset($updates['message'])) {
            $response = Telegram::sendMessage([
                'chat_id' => $updates['message']['from']['id'],
                'text' => 'Вы писали: ' . $updates['message']['text'],
            ]);
        } elseif (isset($updates['channel_post'])) {
            $response = Telegram::sendMessage([
                'chat_id' => $updates['channel_post']['sender_chat']['id'],
                'text' => 'Вы писали: ' . $updates['channel_post']['text'],
            ]);
        } else {
            Log::info('Wrong message');
        }


        return 'ok';
    }

    public function setWebHook() {
        $response = Telegram::setWebhook(['url' => env('TELEGRAM_WEBHOOK_URL')]);
        Log::info($response);
        return;
    }

    public function get_data_from_tg(){
        $content = file_get_contents("php://input");
        $data = json_decode($content, true);

        if(isset($data['callback_query']))
            $data = $data['callback_query'];
        if(isset($data['message']))
            $data = $data['message'];

        $message = mb_strtolower(($data['text'] ? $data['text']
            : $data['data']) , 'utf-8' );
        $method = 'sendMessage';
        switch ($message){
            case '/start':
                $send_data = [
                    'text'=>'Hi'
                ];
                break;
            default:
                $send_data = [
                    'text'=>'Try another text'
                ];
        }
        $send_data['chat_id']=$data['chat']['id'];
        return $this->sendTelegram($method,$send_data);
    }

    private function sendTelegram($method,$data,$headers=[]){

        $handle = curl_init(
            'https://api.telegram.org/bot5649872138:AAEH1o1FSuJfjqwvbavQLOd8Bzpr3UICL3w'
            .'/'.$method);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_HEADER, 0);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($handle, CURLOPT_HTTPHEADER,
            array_merge( array("Content-Type: application/json"),
                $headers ) );
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($handle, CURLOPT_TIMEOUT, 60);

        $result = curl_exec($handle);
        curl_close($handle);
        return ( json_decode($result,1) ? json_decode($result,1) :
            $result);
    }
}
