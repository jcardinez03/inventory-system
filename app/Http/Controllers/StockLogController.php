<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockLog;
use Illuminate\Support\Facades\Auth;

class StockLogController extends Controller
{
    private $stocklog;
    private $product;
    public function __construct(StockLog $stocklog, Product $product)
    {
        $this->stocklog = $stocklog;
        $this->product = $product;
    }

    public function index($status, Request $request)
    {
        $all_products = $this->product->where('user_id', Auth::user()->id)->get();
            
        $status = strtoupper($status);
        /* if ($request->product_id) {
    $query->where('product_id', $request->product_id);
}
    */
        $query = $this->stocklog
                        ->when($status !== 'ALL', fn($q) => $q->where('type', $status))
                        ->when($request->product_id, fn($q) => $q->where('product_id', $request->product_id))
                        ->latest();

        $all_stocklogs = $query->get();

        
        return view('stocklog.index')
                ->with('all_stocklogs', $all_stocklogs)
                ->with('all_products', $all_products);
    }
}
