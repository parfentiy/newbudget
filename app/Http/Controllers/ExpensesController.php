<?php

namespace App\Http\Controllers;

use App\Http\Controllers\TelegrammBot;
use Illuminate\Http\Request;
use App\Models\expenses;
use Carbon\Carbon;

class ExpensesController extends Controller
{
    //
    public function addNewExpense(Request $request)
    {
        $request->directive = 'newexpense';

        TelegrammBot::sendMessage($request);

        date_default_timezone_set("Europe/Moscow");
        expenses::create([
                'sum' => $request->sum,
                'expensestypes_id' => $request->expType,
                'comment' => $request->comment,
                'user_id' => 1,
                'created_at' => $request->date . ' ' . date('H:i:s'),
        ]);
        return redirect()->route('mainpage');
    }

    public function deleteExpense(Request $request)
    {
        $request->directive = 'deleteexpense';
        TelegrammBot::sendMessage($request);

        expenses::find($request->action)->delete();

        return back();
    }
}
