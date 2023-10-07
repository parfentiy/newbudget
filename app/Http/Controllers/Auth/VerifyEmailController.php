<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
<<<<<<< HEAD
use Illuminate\Http\RedirectResponse;
=======
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
<<<<<<< HEAD
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
=======
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

<<<<<<< HEAD
        return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
=======
        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
    }
}
