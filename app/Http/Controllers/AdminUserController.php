<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminUserController extends Controller
{
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:5', 'max:255'],
            'email' => ['required', 'min:5'], 
            'password' => ['nullable', 'min:8', Password::defaults()],
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);
        return to_route('admin.table', ['user' => $user]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return to_route('admin.table');
    }
}

