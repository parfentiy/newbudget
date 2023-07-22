<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class BanController extends Controller
{
    //
    public function ban()
    {
        // ban for days
        //$ban_for_next_7_days = Carbon::now()->addDays(7);
        //$ban_for_next_14_days = Carbon::now()->addDays(14);
        $ban_permanently = 0;

        // ban user
        $user_id = 1;
        $user = User::find($user_id);
        $user->banned_till = $ban_permanently;
        $user->save();
    }

    public function bannedStatus()
    {
        $user_id = 1;
        $user = User::find($user_id);

        $message = "The user is not banned";
        if ($user->banned_till != null) {
            if ($user->banned_till == 0) {
                $message = "Banned Permanently";
            }

            if (now()->lessThan($user->banned_till)) {
                $banned_days = now()->diffInDays($user->banned_till) + 1;
                $message = "Suspended for " . $banned_days . ' ' . Str::plural('day', $banned_days);
            }
        }

        dd($message);
    }

    public function unban()
    {
        $user_id = 1;
        $user = User::find($user_id);
        $user->banned_till = null;
        $user->save();
    }
}
