<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncomesType;

class IncomesTypeController extends Controller
{
    //
    public function addNewIncomeType(Request $request)
    {
        IncomesType::create([
            'name' => $request->name,
            'is_percent' => $request->ispercent ? 1 : 0
        ]);
        return redirect()->route('mainpage');
    }
}
