<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    # a category has many Products
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    # get products under category
    public function categoryProduct()
    {
        return $this->hasMany(CategoryProduct::class);
    }
}
