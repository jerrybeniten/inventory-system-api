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

    public function update(array $data, $product)
    {
        $product->update(
            [
                'name' => $data['name'],
                'description' => $data['description'],
                'type_id' => $data['type_id'],
                'quantity' => $data['quantity'],
                'unit_price' => $data['unit_price'],
            ]
        );
    }
}
