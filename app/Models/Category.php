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
}
