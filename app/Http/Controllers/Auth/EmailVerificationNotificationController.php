<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
<<<<<<< HEAD
use Illuminate\Http\RedirectResponse;
=======
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
<<<<<<< HEAD
     */
    public function store(Request $request): RedirectResponse
=======
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
