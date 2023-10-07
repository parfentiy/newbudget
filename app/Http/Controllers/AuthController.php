<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Foundation\Auth\User as Authenticatable;


class AuthController extends Controller
{
    /**
     * Create a new registered user.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function register(Request $request)
    {
        $creator = new CreateNewUser;
        $user = $creator->create($request->all());
        event(new Registered($user));
        $token = $user->createToken('API'); //or device name,client,etc
        return response()->json(['token' => $token->plainTextToken]);
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('token-name');
            return response()->json(['token' => $token->plainTextToken]);
        }
        else {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
    }

    /**
     * Logout the current sessions
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function logout(Request $request)
    {
        //Optionally destroy the current token
        //Auth::user()->currentAccessToken()->delete();
        Auth::logout();
    }
}
