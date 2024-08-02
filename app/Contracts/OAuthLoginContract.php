<?php

namespace App\Contracts;

interface OAuthLoginContract
{
    public function login(array $data);
}
