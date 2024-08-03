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

    public function read()
    {
        return $this->model->paginate();
    }

    public function update(array $data, $user)
    {
        $user->update(
            [
                'name' => $data['name'],
                'description' => $data['description'],
                'type_id' => $data['type_id'],
                'quantity' => $data['quantity'],
                'unit_price' => $data['unit_price'],
            ]
        );
    }

    public function delete($user)
    {
        $user->delete();
    }
}
