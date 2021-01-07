<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function github()
    {
        return Socialite::driver('github')->redirect();
    }
    public function githubRedirect()
    {
        $user = Socialite::driver('github')->user();
        $users = User::firstOrCreate([
            'email' => $user->email

        ], [
            'name' => $user->name,
            'password' => Hash::make(Str::random(15)),
        ]);
        Auth::login($user, true);
        return redirect('/dashboard');
    }
}
