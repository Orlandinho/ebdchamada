<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function edit(User $user, Request $request)
    {
        if (! $request->hasValidSignature()){
            abort(403);
        }

        return view('password.passwordForm',[
            'user' => $user
        ]);
    }

    public function update(User $user, Request $request)
    {
        $attributes = $request->validate([
            'password' => ['required','confirmed','min:8']
        ]);

        $user->password = Hash::make($attributes['password']);
        $user->save();

        return redirect('login');
    }
}
