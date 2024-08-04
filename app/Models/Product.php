<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'description',        
        'quantity',
        'unit_price'
    ];

    public function categories(): void
    {
        $this->belongsToMany(Category::class);
    }
}
