<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = 'product';

    protected $fillable = [
        'title',
        'price',
        'product_code',
        'description'
    ];
}
