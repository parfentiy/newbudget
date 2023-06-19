<?php

namespace App\Http\Controllers;

use App\Models\expenses;
use App\Models\Incomes;
use Illuminate\Http\Request;
use App\Models\IncomesType;
use App\Models\ExpensesType;

class TelegrammBot extends Controller
{
    //
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

        }
        return;
    }
}
