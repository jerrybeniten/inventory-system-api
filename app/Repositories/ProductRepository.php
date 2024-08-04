<?php

namespace App\Repositories;

use App\Contracts\EloquentContract;
use App\Models\Product;
use App\Models\Category;
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
        $product = $this->model->create($data);
        $product->categories()->attach($data['categories']);
    }
    
    /**
     * read
     *
     * @return LengthAwarePaginator
     */
    public function read(): LengthAwarePaginator
    {
        return $this->model::with('categories')->paginate(5);        
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
                'quantity' => $data['quantity'],
                'unit_price' => $data['unit_price'],
            ]
        );

        $product->categories()->sync($data['categories']);
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
