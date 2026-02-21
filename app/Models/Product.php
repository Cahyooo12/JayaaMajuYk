<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'category',
        'price',
        'original_price',
        'description',
        'image',
        'images',
        'tags',
        'is_ready_stock',
        'is_best_seller',
        'specs',
    ];

    protected $casts = [
        'images' => 'array',
        'tags' => 'array',
        'specs' => 'array',
        'is_ready_stock' => 'boolean',
        'is_best_seller' => 'boolean',
    ];
}
