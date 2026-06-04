<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockLog extends Model
{
    public const STOCK_IN = 'IN';
    public const STOCK_OUT = 'OUT';
    public const STOCK_ADJUST = 'ADJUST';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
