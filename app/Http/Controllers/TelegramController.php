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

        //die();
        if (isset($updates['message'])) {
            Log::info('Принято сообщение от ' . $updates['message']['from']['id'] . ': ' . $updates['message']['text']);

            $this->mainLogic($updates['message']['text'], $updates['message']['from']['id']);
        } elseif (isset($updates['channel_post'])) {

            Log::info('Принято сообщение от ' . $updates['channel_post']['sender_chat']['id'] . ': ' .
                $updates['channel_post']['text']);

            $this->mainLogic($updates['channel_post']['text'], $updates['channel_post']['sender_chat']['id']);
        } elseif (isset($updates['callback_query'])) {

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
                $reply_markup = json_encode(['inline_keyboard' => [] ]);
                break;
            default:
                $message = "Вот кнопки";
                $reply_markup = json_encode(
                    [
                        'inline_keyboard' =>
                        [
                            [
                                [
                                    'text' => 'Button 1',
                                    'callback_data' => 'button1',
                                ],
                                [
                                    'text' => 'Button 2',
                                    'callback_data' => 'button2',
                                ],
                            ]
                        ],
                    ]
                );

        }

        $response = Telegram::sendMessage([
            'chat_id' => $chatId,
            'text' => $message,
            'reply_markup' => $reply_markup,
        ]);
    }

    public function setWebHook() {
        $response = Telegram::setWebhook(['url' => env('TELEGRAM_WEBHOOK_URL')]);
        Log::info($response);
        return;
    }

}
