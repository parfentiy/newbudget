<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\Account;
use App\Models\User;

class GodController extends Controller
{
    public function showUsers() {

        return view('admin.users');
    }
}
