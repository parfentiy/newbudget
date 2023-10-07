<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
<<<<<<< HEAD
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
=======
use Illuminate\Http\Request;
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
<<<<<<< HEAD
     */
    public function __invoke(Request $request): RedirectResponse|View
=======
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function __invoke(Request $request)
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(RouteServiceProvider::HOME)
                    : view('auth.verify-email');
    }
}
