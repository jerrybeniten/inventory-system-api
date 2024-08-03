<?php

namespace App\Contracts;

/**
 * EloquentContract
 */
abstract class EloquentContract {
    abstract public function create(array $data);
    abstract public function read();
    abstract public function update(array $data, $model);
}