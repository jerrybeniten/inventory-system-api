<?php

namespace App\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

/**
 * EloquentContract
 */
abstract class EloquentContract {
    abstract public function create(array $data): void;
    abstract public function read(): LengthAwarePaginator;
    abstract public function update(array $data, $model): void;
    abstract public function delete($model);
}