<?php

namespace App\Http\Controllers;

use App\Http\Controllers\TelegrammBot;
use App\Models\expenses;
use Illuminate\Http\Request;
use App\Models\Incomes;


class IncomesController extends Controller
{
    //
    public function addNewIncome(Request $request)
    {
        $request->directive = 'newincome';

        TelegrammBot::sendMessage($request);

        Incomes::create([
            'sum' => $request->sum,
            'incomes_types_id' => $request->incType,
            'user_id' => 1,
            'created_at' => $request->date . ' ' . date('H:i:s'),
        ]);
        return redirect()->route('mainpage');
    }

    public function deleteIncome(Request $request)
    {
        $request->directive = 'deleteincome';

        TelegrammBot::sendMessage($request);

        Incomes::find($request->income)->delete();
        return back();
    }
}
