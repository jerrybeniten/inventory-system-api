<?php

namespace App\Repositories;

use App\Contracts\EloquentContract;
use App\Models\Product;

class ProductRepository extends EloquentContract
{
    private $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        $this->model->create($data);
    }

    public function read()
    {
        return $this->model->paginate(5);
    }
}
