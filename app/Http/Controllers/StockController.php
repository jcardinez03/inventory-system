<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\StockLog;
use Illuminate\Support\Facades\Auth;
class StockController extends Controller
{
    private $stock;
    private $stock_log;
    
    public function __construct(Stock $stock, StockLog $stock_log)
    {
        $this->stock = $stock;
        $this->stock_log = $stock_log;
    }

    public function store($product_id)
    {
        # stock add
        $stock = $this->stock->findOrFail($product_id);
        
        $before = $stock->quantity;
        $this->stock_log->before_stock = $before;

        $stock->quantity += 1;
        $stock->save();

        $change = 1;
        $after = $before + $change;
        # stock log add update
        $this->stock_log->user_id = Auth::user()->id;
        $this->stock_log->product_id = $product_id;
        $this->stock_log->type = StockLog::STOCK_IN;
        $this->stock_log->quantity = $change;
        $this->stock_log->after_stock = $after;
        $this->stock_log->save();

        return back();
    }

    public function destroy($product_id)
    {
        # stock subtract update
        $stock = $this->stock->findOrFail($product_id);
        $before = $stock->quantity;
        $this->stock_log->before_stock = $before;

        $stock->quantity -= 1;
        $stock->save();

        
        # stock log subtract update
        $change = 1;
        $after = $before - $change;

        $this->stock_log->user_id = Auth::user()->id;
        $this->stock_log->product_id = $product_id;
        $this->stock_log->type = StockLog::STOCK_OUT;
        $this->stock_log->quantity = $change;
        $this->stock_log->after_stock = $after;
        $this->stock_log->save();

        return back();
    }

    public function update(Request $request, $product_id)
    {
        $stock = $this->stock->findOrFail($product_id);

        $before = $stock->quantity;
        $this->stock_log->before_stock = $before;

        # enter new stocks
        $stocks_in = $request->input('quantity_in' . $product_id);
        $stocks_out = $request->input('quantity_out' . $product_id);
        $new_quantity = $before + $stocks_in - $stocks_out;
        $stock->quantity = $new_quantity;
        $stock->save();


        $this->stock_log->user_id = Auth::user()->id;
        $this->stock_log->product_id = $product_id;
        if($stocks_in >= 0){
            $this->stock_log->type = StockLog::STOCK_IN;
        } elseif ($stocks_out > 0) {
            $this->stock_log->type = StockLog::STOCK_OUT;
        }
        $this->stock_log->quantity = $stocks_in + $stocks_out;
        $this->stock_log->after_stock = $new_quantity;
        $this->stock_log->save();

        return back();
    }
}
