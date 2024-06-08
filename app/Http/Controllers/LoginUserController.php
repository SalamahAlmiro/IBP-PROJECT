<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Route;


class LoginUserController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'The email does not exist in our records.',
            ])->withInput($request->only('email'));
        }

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return back()->withErrors([
                'password' => 'The provided password is incorrect.',
            ])->withInput($request->only('email'));
        }

        return redirect()->intended(route('posts.index'));
    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('posts.index');
    }
}
