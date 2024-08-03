<?php

namespace App\Contracts;

abstract class EloquentContract {
    abstract public function create(array $data);
    abstract public function read();
}