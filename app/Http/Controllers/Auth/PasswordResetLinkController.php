<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
=======
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
<<<<<<< HEAD
     */
    public function create(): View
=======
     *
     * @return \Illuminate\View\View
     */
    public function create()
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
<<<<<<< HEAD
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
=======
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }
}
