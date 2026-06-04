<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    # a product has many stocks
    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

    # a product has one category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function stockLog()
    {
        return $this->hasMany(StockLog::class);
    }
}
