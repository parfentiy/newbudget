<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
<<<<<<< HEAD
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
=======
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27

class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view.
<<<<<<< HEAD
     */
    public function show(): View
=======
     *
     * @return \Illuminate\View\View
     */
    public function show()
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
    {
        return view('auth.confirm-password');
    }

    /**
     * Confirm the user's password.
<<<<<<< HEAD
     */
    public function store(Request $request): RedirectResponse
    {
        if (
            ! Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
            ])
        ) {
=======
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function store(Request $request)
    {
        if (! Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
