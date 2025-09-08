<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }


    public function login_check(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|max:30',
        ]);

        $creds = $request->only('email', 'password');
        $user = Auth::attempt($creds, $request->has('remember'));

        if ($user) {
            return redirect()->intended(route('dashboard'))->with('success', 'Login successfully');
        } else {
            return redirect()->route('login')->with('error', 'Email and Password Does not match');
        }
    }


    public function loged_out(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }

        return redirect()->route("login")->with('success', 'Logout Successfully Complete');
    }
}
