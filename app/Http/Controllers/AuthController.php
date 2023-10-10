<?php

namespace App\Http\Controllers;

use App\Mail\DefaultPasswordMail;
use App\Models\Pemohon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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
            $password = Str::random(8);
            if ($user = User::create([
                'name' => $gUser->getName(),
                'email' => $email,
                'password' => Hash::make($password),
            ])) {
                $user->markEmailAsVerified();
                Pemohon::create([
                    'user_id' => $user->id
                ]);
                \Mail::to($email)->queue(new DefaultPasswordMail($password));
            }
        }
        \Auth::login($user);
        return redirect(route('app.index'));
    }
}
