<?php

namespace App\Http\Controllers;

use App\Models\Pemohon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        $gUser = Socialite::driver('google')->user();
        $email = $gUser->getEmail();
        if (!$user = User::where('email', $email)->first()) {
            $user = User::create([
                'name' => $gUser->getName(),
                'email' => $email,
                'password' => Hash::make(\Str::random(8)),
            ]);
            $user->markEmailAsVerified();
            Pemohon::create([
                'user_id' => $user->id
            ]);
        }
        \Auth::login($user);
        return back();
    }
}
