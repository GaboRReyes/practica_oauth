<?php

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function redirectDiscord()
    {
        return Socialite::driver('discord')->redirect();
    }

    public function handleDiscordCallback()
    {
        $discordUser = Socialite::driver('discord')->user();

        $user = User::updateOrCreate([
            'email' => $discordUser->email,
        ],[
            'name' => $discordUser->name,
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }

    public function redirectSpotify()
    {
        return Socialite::driver('spotify')->redirect();
    }

    public function handleSpotifyCallback()
    {
        $spotifyUser = Socialite::driver('spotify')->user();

        $user = User::updateOrCreate([
            'email' => $spotifyUser->email,
        ],[
            'name' => $spotifyUser->name,
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }

}