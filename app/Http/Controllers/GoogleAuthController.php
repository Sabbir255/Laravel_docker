<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function google_auth()
    {
        return Socialite::driver('google')->redirect();
    }


    public function google_auth_callback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Check if the user exists
            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {
                // Create a new user
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt(uniqid()) 
                ]);
            }

            // Login the user
            Auth::login($user);

            return redirect()->intended(route('dashboard'))->with('success', 'Login successfully');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Something Wrong');
        }
    }
}
