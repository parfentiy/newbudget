<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
<<<<<<< HEAD
use Illuminate\Http\RedirectResponse;
=======
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
<<<<<<< HEAD
use Illuminate\View\View;
=======
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
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
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
<<<<<<< HEAD
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
=======
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
