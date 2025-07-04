<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'id',
        'product_name',
        'product_image',
        'product_price',
        'product_description',
    ];

    public $incrementing = false;
    protected $keyType = 'string';
}