<?php

use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return "Login exitoso";
});

Route::get('/auth/discord', [AuthController::class, 'redirectDiscord']);
Route::get('/auth/discord/callback', [AuthController::class, 'handleDiscordCallback']);

Route::get('/auth/spotify', [AuthController::class, 'redirectSpotify']);
Route::get('/auth/spotify/callback', [AuthController::class, 'handleSpotifyCallback']);