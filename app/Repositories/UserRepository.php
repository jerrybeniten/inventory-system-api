<?php

namespace App\Repositories;

use App\Contracts\EloquentContract;
use App\Models\User;

class UserRepository extends EloquentContract
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        $this->model->create($data);
    }
}
