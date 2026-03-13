<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{


    public function redirectDiscord()
{
    return Socialite::driver('discord')
        ->scopes(['identify','email'])
        ->redirect();
}

public function handleDiscordCallback()
{
    $discordUser = Socialite::driver('discord')
        ->stateless()
        ->user();

    $email = $discordUser->email ?? $discordUser->id.'@discord.local';

    $user = User::updateOrCreate([
        'email' => $email,
    ],[
        'name' => $discordUser->name,
        'password' => bcrypt(\Illuminate\Support\Str::random(16)),
    ]);

    Auth::login($user);

    return redirect('/dashboard');
}

    public function redirectSpotify()
    {
        return Socialite::driver('spotify')
    ->scopes(['user-read-email'])
    ->redirect();
    }

    public function handleSpotifyCallback()
{
    $spotifyUser = Socialite::driver('spotify')
        ->stateless()
        ->user();

    $email = $spotifyUser->email ?? $spotifyUser->id.'@spotify.local';

    $user = User::updateOrCreate([
        'email' => $email,
    ],[
        'name' => $spotifyUser->name,
        'password' => bcrypt(Str::random(16)),
    ]);

    Auth::login($user);

    return redirect('/dashboard');
}

}