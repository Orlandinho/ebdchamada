<?php

namespace App\Http\Controllers;

use App\Mail\SendPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class PasswordController extends Controller
{
    public function edit(User $user, Request $request)
    {
        if (! $request->hasValidSignature() || $user->password){
            return response()->view('error.link-expired', [], 403);
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
        // TODO implement
        // Show message and redirect after some seconds
        return redirect('login');
    }

    public function resend(User $user)
    {
        $user->update(['password' => null]);

        $link = URL::temporarySignedRoute('password_create', now()->addDays(2), $user->id);
        Mail::to($user->email)->send(new SendPassword($user, $link));
        toast("E-mail para criação de senha reenviado", 'success')->hideCloseButton();
        return redirect()->back();
    }
}
