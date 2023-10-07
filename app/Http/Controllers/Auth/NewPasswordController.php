<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
<<<<<<< HEAD
use Illuminate\Http\RedirectResponse;
=======
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
<<<<<<< HEAD
use Illuminate\View\View;
=======
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
<<<<<<< HEAD
     */
    public function create(Request $request): View
=======
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
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
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }
}
