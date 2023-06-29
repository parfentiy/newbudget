<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\Account;

class AccountController extends Controller
{
    //
    public function show() {
        $categories = Account::where('user_id', Auth::user()->id)->where('category', 0)->get();
        $subCategories = Account::where('user_id', Auth::user()->id)->where('category', '!=', 0)->get();
        //dd($subCategories);

        return view('categories.show', [
            'categories' => $categories,
            'subCategories' => $subCategories,
        ]);
    }

    public function save() {
        //dd(request());
        $account = Account::find(request()->id);
        $account->name = request()->name;
        $account->order_number = request()->order_number;

        $account->save();

        return redirect()->back();
    }

    public function delete() {
        //dd(request());
        Account::find(request()->id)->delete();

        return redirect()->back();
    }
}
