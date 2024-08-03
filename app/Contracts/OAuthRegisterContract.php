<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Client\Response;

interface OAuthRegisterContract
{    
    /**
     * register
     *
     * @param  array $data
     * @return Response
     */
    public function register(array $data): Response;
}
