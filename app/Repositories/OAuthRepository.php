<?php

namespace App\Repositories;

use App\Contracts\OAuthLoginContract;
use App\Contracts\OAuthRegisterContract;
use Illuminate\Support\Facades\Http;

class OAuthRepository implements OAuthRegisterContract, OAuthLoginContract
{
    public function register(array $data)
    {
        return Http::post(env('APP_URL') . '/oauth/token', [
            'grant_type' => 'password',
            'client_id' => env('PASSPORT_PASSWORD_CLIENT_ID'),
            'client_secret' => env('PASSPORT_PASSWORD_SECRET'),
            'username' => $data['email'],
            'password' => $data['password'],
            'scope' => '',
        ]);
    }

    public function login(array $data)
    {
        return Http::post(env('APP_URL') . '/oauth/token', [
            'grant_type' => 'password',
            'client_id' => env('PASSPORT_PASSWORD_CLIENT_ID'),
            'client_secret' => env('PASSPORT_PASSWORD_SECRET'),
            'username' => $data['email'],
            'password' => $data['password'],
            'scope' => '',
        ]);
    }
}
