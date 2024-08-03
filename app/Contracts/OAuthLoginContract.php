<?php

namespace App\Contracts;

use Illuminate\Http\Client\Response;

interface OAuthLoginContract
{
    public function login(array $data): Response;
}
