<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors('Login dengan Google gagal.');
        }

        // Cek user berdasarkan email
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // Buat user baru jika belum ada
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => bcrypt(Str::random(24)), // password random karena login pakai Google
            ]);

            // Assign role 'user' ke user baru
            if (method_exists($user, 'assignRole')) {
                $user->assignRole('user');
            } elseif (property_exists($user, 'role')) {
                $user->role = 'user';
                $user->save();
            }
        }

        Auth::login($user, true); // login user

        return redirect('/dashboard');
    }
}
