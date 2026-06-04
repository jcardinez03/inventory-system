<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    # a stock belongs to a product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
