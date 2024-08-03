<?php

namespace App\Repositories;

use App\Contracts\EloquentContract;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;


/**
 * ProductRepository
 */
class ProductRepository extends EloquentContract
{
    private $model;
    
    /**
     * __construct
     *
     * @param  mixed $model
     * @return void
     */
    public function __construct(Product $model)
    {
        $this->model = $model;
    }
    
    /**
     * create
     *
     * @param  mixed $data
     * @return void
     */
    public function create(array $data): void
    {
        $this->model->create($data);
    }
    
    /**
     * read
     *
     * @return LengthAwarePaginator
     */
    public function read(): LengthAwarePaginator
    {
        return $this->model->paginate(5);
    }
    
    /**
     * update
     *
     * @param  mixed $data
     * @param  mixed $product
     * @return void
     */
    public function update(array $data, $product): void
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
    
    /**
     * delete
     *
     * @param  mixed $product
     * @return void
     */
    public function delete($product): void
    {
        $product->delete();
    }
}
