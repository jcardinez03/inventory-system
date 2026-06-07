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

    public function __construct(StockLog $stocklog)
    {
        $this->stocklog = $stocklog;
    }

    public function index()
    {
        $all_stocklogs = $this->stocklog->where('id', '==', Auth::user()->id);
        return view('stocklog.index')->with('all_stocklogs', $all_stocklogs);
    }
}
