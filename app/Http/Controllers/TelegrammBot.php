<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
=======
use App\Models\expenses;
use App\Models\Incomes;
use Illuminate\Http\Request;
use App\Models\IncomesType;
use App\Models\ExpensesType;
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27

class TelegrammBot extends Controller
{
    //
<<<<<<< HEAD
    static public function sendMessage($message) {

        $userSetting = Setting::where('user_id', Auth::user()->id)->first();
        if ($userSetting->is_tbot_active) {
            //ID канала куда отправляем
            //$idChannel = '-1001588576570';
            $idChannel = $userSetting->tbot_channel_id;
            //токен бота которым отправляем сообщение
            //$botToken = '5649872138:AAEH1o1FSuJfjqwvbavQLOd8Bzpr3UICL3w';
            $botToken = $userSetting->tbot_token;
            //кодируем его, чтобы сохранить переносы строк
            $message = urlencode($message);
            //после этого отправляем
            try {
                file_get_contents("https://api.telegram.org/bot$botToken/sendMessage?chat_id=$idChannel&text=" . $message);
            } catch (\Exception $e) {

            }
=======
    static public function sendMessage(Request $request) {
        switch ($request->directive) {
            case 'newexpense':
                $message = "Произведена затрата: \n" .
                    "на дату " . $request->date . "\n" .
                    "по статье " . ExpensesType::find($request->expType)->name . "\n" .
                    "на " . $request->sum . " рублей.\n" .
                    "Комментарий к расходу: " . $request->comment . "\n" .
                    "---- Экономьте ваши средства ----";

                break;
            case 'newincome':
                $message = "Ура!! Поступил доход: \n" .
                    "на дату " . $request->date . "\n" .
                    "по статье " . IncomesType::find($request->incType)->name . "\n" .
                    "на " . $request->sum . " рублей.\n" .
                    "Поздравляю!!!" . $request->comment;

                break;
            case 'deleteexpense':
                $expType = expenses::find($request->action)->expensestypes_id;
                $message = "Удален расход: \n" .
                    "по статье " . ExpensesType::find($expType)->name . "\n" .
                    "на " . expenses::find($request->action)->sum . " рублей.\n" .
                    "от " . expenses::find($request->action)->created_at;

                break;
            case 'deleteincome':
                $incType = Incomes::find($request->income)->incomes_types_id;
                $message = "Удален доход: \n" .
                    "по статье " . IncomesType::find($incType)->name . "\n" .
                    "на " . Incomes::find($request->income)->sum . " рублей.\n" .
                    "от " . Incomes::find($request->income)->created_at;

                break;

        }
        //ID канала куда отправляем
        $idChannel = '-1001588576570';
//токен бота которым отправляем сообщение
        $botToken = '5649872138:AAEH1o1FSuJfjqwvbavQLOd8Bzpr3UICL3w';
//наше импровизированное сообщение
        //$message = $request->message;
//кодируем его, чтобы сохранить переносы строк
        $message = urlencode($message);
//после этого отправляем
        try {
            file_get_contents("https://api.telegram.org/bot$botToken/sendMessage?chat_id=$idChannel&text=".$message);
        }
        catch (\Exception $e){

>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
        }
        return;
    }
}
