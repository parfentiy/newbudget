<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    //
    public function showTransactions() {
        $transactions = \App\Models\CashFlow::where('user_id', Auth::user()->id)->orderBy('operation_date')->get();
        return view('reports.transactions', [
            'transactions' => $transactions,
        ]);
    }


}
