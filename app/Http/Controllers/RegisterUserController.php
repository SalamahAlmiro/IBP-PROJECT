<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class RegisterUserController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=> ['required', 'min:3', 'max:40', 'string'],
            'email'=> ['required', 'email', 'unique:users'],
            'password'=> ['required', 'min:6', 'confirmed', Password::defaults()],
        ]); 
        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
        ]);
        auth()->login($user);
        return to_route('posts.index');
    }

    public function newUser()
    {
        return view('auth.newUser');
    }

    public function storeNew(Request $request)
    {
        $request->validate([
            'name'=> ['required', 'min:3', 'max:40', 'string'],
            'email'=> ['required', 'email', 'unique:users'],
            'password'=> ['required', 'min:6', 'confirmed', Password::defaults()],
        ]); 
        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
        ]);
        return to_route('admin.table');
    }
}
