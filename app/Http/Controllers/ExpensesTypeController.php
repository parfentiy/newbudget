<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpensesType;

class ExpensesTypeController extends Controller
{
    //
    public function addNewExpenseType(Request $request)
    {
        ExpensesType::create([
            'name' => $request->name,
            'is_percent' => $request->ispercent ? 1 : 0,
            'percent' => $request->percent,
            'order_num' => $request->ordernum,
        ]);
        return redirect()->route('mainpage');
    }
}
