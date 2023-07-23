<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Account;
use \App\Models\CashFlow;
use Illuminate\Support\Facades\Auth;

class CashFlowController extends Controller
{
    //
    public function index() {

        $categories = Account::where('user_id', Auth::user()->id)->where('category', 0)->get();
        $subCategories = Account::where('user_id', Auth::user()->id)->where('category', '!=', 0)->get();

        return view('transactions.new-transaction', [
            'categories' => $categories,
            'subCategories' => $subCategories,
        ]);
    }

    public function create() {
        CashFlow::create([
            'amount' => request()->amount,
            'operation_date' => request()->operation_date,
            'user_id' => Auth::user()->id,
            'description' => request()->description,
            'source_account_id' => request()->source_account_id,
            'dest_account_id' => request()->dest_account_id,
        ]);

        return redirect()->back();
    }

    public function delete() {
        CashFlow::find(request()->id)->delete();

        return redirect()->back();
    }
}
