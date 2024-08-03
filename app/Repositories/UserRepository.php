<?php

namespace App\Repositories;

use App\Contracts\EloquentContract;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;


/**
 * UserRepository
 */
class UserRepository extends EloquentContract
{
    private $model;
    
    /**
     * __construct
     *
     * @param  mixed $model
     * @return void
     */
    public function __construct(User $model)
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
        return $this->model->paginate();
    }
    
    /**
     * update
     *
     * @param  mixed $data
     * @param  mixed $user
     * @return void
     */
    public function update(array $data, $user): void
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
    
    /**
     * delete
     *
     * @param  mixed $user
     * @return void
     */
    public function delete($user): void
    {
        $user->delete();
    }
}
