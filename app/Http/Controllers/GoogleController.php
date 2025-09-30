<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback() {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $findUser = User::where('google_id', $googleUser->id)->first();

            if ($findUser) {
                Auth::login($findUser);
            } else {
                $username = str_replace(' ', '_', strtolower(preg_replace('/[^A-Za-z0-9 ]/', '', $googleUser->name)));
            
                $user = User::updateOrCreate([
                    'email' => $googleUser->email,
                ], [
                    'username' => $username,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt('12345678'), // Use bcrypt for hashing the password
                ]);
            
                Auth::login($user);
            }
            return redirect()->intended('/');
        } catch (\Exception $e) {
            return redirect('auth/google');
        }
    }
}