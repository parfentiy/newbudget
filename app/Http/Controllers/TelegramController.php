<?php

namespace App\Http\Controllers;
<<<<<<< HEAD
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Facades\Log;
=======
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27

use Illuminate\Http\Request;

class TelegramController extends Controller
{
<<<<<<< HEAD
    protected $mainMenu = [ 'inline_keyboard' => [[
                        [
                            'text' => 'Новая проводка',
                            'callback_data' => 'newTransaction',
                        ],
                        [
                            'text' => 'Последние проводки',
                            'callback_data' => 'lastTransactions',
                        ],
                        [
                            'text' => 'Бюджеты в PDF',
                            'callback_data' => 'budgetsPdf',
                        ],
                    ]]];

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
        Log::info('==============');
        Log::info($updates);

        $preparedMessage = $this->prepareMessage($updates);
        $user = Setting::where('tbot_channel_id', $preparedMessage['chatId'])->firstOr(function () {
            Log::info('Пользователь не существует');

            return 'Restricted';
        });
        //Log::info('UserData - ' . $user);
        if ($user === 'Restricted') {
            $response = Telegram::sendMessage([
                'chat_id' => $preparedMessage['chatId'],
                'text' => 'Отказано в доступе',
            ]);
        }
        else {
            if ($user->is_tbot_active) {
                Log::info('Пользователь ' . $preparedMessage['chatId'] . ' пишет:');
                $this->mainLogic($preparedMessage);
            }
        }

        return 'ok';
    }

    private function prepareMessage($sourceMessage)
    {
        if (isset($sourceMessage['message'])) {
            $preparedMessage = [
                'type' => 'textFromUser',
                'chatId' => $sourceMessage['message']['from']['id'],
                'text' => $sourceMessage['message']['text'],
            ];
        } elseif (isset($sourceMessage['channel_post'])) {
            $preparedMessage = [
                'type' => 'textFromChannel',
                'chatId' => $sourceMessage['channel_post']['sender_chat']['id'],
                'text' => $sourceMessage['channel_post']['text'],
            ];
        } elseif (isset($sourceMessage['callback_query'])) {
            $preparedMessage = [
                'type' => 'button',
                'chatId' => $sourceMessage['callback_query']['message']['chat']['id'],
                'text' => $sourceMessage['callback_query']['data'],
            ];
        } else {
            Log::info('Wrong message');
        }

        return $preparedMessage;
    }

    private function mainLogic($messageArray) {
        $user = Setting::where('tbot_channel_id', $messageArray['chatId'])->first();
        Log::info('Current menu position: ' . $user->menu_position);
        $menuPosition = $user->menu_position;

        if ($messageArray['type'] === 'textFromUser' || $messageArray['type'] === 'textFromChannel') {
            switch ($messageArray['text']) {
                case '/help':
                    $message = "Нужна помощь?";
                    $reply_markup = json_encode(['inline_keyboard' => []]);
                    break;
                default:
                    $message = "Основное меню";
                    $reply_markup = json_encode($this->mainMenu);

            }
        } elseif ($messageArray['type'] === 'button') {
            switch ($messageArray['text']) {
                case 'lastTransactions':
                    $message = "Задайте количество последних проводок";
                    $reply_markup = json_encode(['inline_keyboard' => []]);
                    $menuPosition = '2.1';
                    break;
                case 'button2':
                    $message = "Нажата кнопка2";
                    $reply_markup = json_encode(['inline_keyboard' => []]);
                    break;
                default:
                    $message = "Хер пойми что нажато";
                    $reply_markup = json_encode(['inline_keyboard' => []]);
                    break;

            }
        }
        $response = Telegram::sendMessage([
            'chat_id' => $messageArray['chatId'],
            'text' => $message,
            'reply_markup' => $reply_markup,
        ]);

        $user->menu_position = $menuPosition;
        $user->save();
    }

    public function setWebHook() {
        $response = Telegram::setWebhook(['url' => env('TELEGRAM_WEBHOOK_URL')]);
        Log::info($response);
        return;
    }

    public function getMe() {
        $response = Telegram::bot('mybot')->getMe();
        Log::info($response);
        return;
    }

=======
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
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
}
