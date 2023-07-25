<?php

namespace App\Http\Controllers;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
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

    public function send($message) {
        $userSetting = Setting::where('user_id', Auth::user()->id)->first();
        if ($userSetting->is_tbot_active) {
            $idChannel = $userSetting->tbot_channel_id;

            $response = Telegram::sendMessage([
                'chat_id' => $idChannel,
                'text' => $message,
            ]);

            $messageId = $response->getMessageId();
            Log::info($messageId);
        }
    }

    public function getFromBot() {
        $updates = Telegram::getWebhookUpdate();
        Log::info($updates);
        if (isset($updates['message'])) {
            $response = Telegram::sendMessage([
                'chat_id' => $updates['message']['from']['id'],
                'text' => 'Вы писали: ' . $updates['message']['text'],
            ]);
            Log::info('Принято сообщение от ' . $updates['message']['from']['id'] . ': ' . $updates['message']['text']);

            $this->mainLogic($updates['message']['text'], $updates['message']['from']['id']);
        } elseif (isset($updates['channel_post'])) {
            $response = Telegram::sendMessage([
                'chat_id' => $updates['channel_post']['sender_chat']['id'],
                'text' => 'Вы писали: ' . $updates['channel_post']['text'],
            ]);
            Log::info('Принято сообщение от ' . $updates['channel_post']['sender_chat']['id'] . ': ' .
                $updates['channel_post']['text']);

            $this->mainLogic($updates['channel_post']['text'], $updates['channel_post']['sender_chat']['id']);
        } else {
            Log::info('Wrong message');
        }

        //$this->mainLogic($updates['message']['text'], $updates['message']['from']['id']);

        return 'ok';
    }

    private function mainLogic($text, $chatId) {
        switch ($text) {
            case '/help':
                $message = "Нужна помощь?";
                break;
            default:
                $message = "Вот кнопки";

        }

        $response = Telegram::sendMessage([
            'chat_id' => $message,
            'text' => $chatId,
        ]);
    }

    public function setWebHook() {
        $response = Telegram::setWebhook(['url' => env('TELEGRAM_WEBHOOK_URL')]);
        Log::info($response);
        return;
    }

    /*public function get_data_from_tg(){
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
    }*/
}
