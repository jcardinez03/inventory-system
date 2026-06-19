<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Stock;
use App\Models\StockLog;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    private $product;
    private $category;
    private $category_product;
    private $stock;
    private $stock_log;


    public function __construct(Product $product, Category $category, Stock $stock, StockLog $stock_log)
    {
        $this->product = $product;
        $this->category = $category;
        $this->stock = $stock;
        $this->stock_log = $stock_log;
    }

    public function index()
    {
        $all_products = $this->product->latest()->get();

        return view('products.index')->with('all_products', $all_products);
    }

    public function create()
    {
        $all_categories = $this->category->all();

        return view('products.create')->with('all_categories', $all_categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required'
            
        ]);

        $this->product->name = $request->name;
        $this->product->category_id = $request->category;

        # for SKU
        $this->product->sku = $this->createSKU($request->category);
        $this->product->user_id = Auth::user()->id;
        $this->product->save();

        $category_product = [
            'category_id' => $request->category
        ];

        $this->product->categoryProduct()->create($category_product);

        # Stock table

        $this->stock->product_id = $this->product->id;
        $this->stock->quantity = 0;
        $this->stock->save();
    
        return redirect()->route('product.index');
    }

    private function createSKU($category_id)
    {
        $category = $this->category->findOrFail($category_id);

        $prefix = strtoupper(substr($category->name, 0 , 3));
        

        $count = $this->product->where('sku' , 'like' , $prefix .'%')->count();
        $name = $prefix . ($count + 1);

        return $name;
    }

    public function destroy($product_id)
    {
        $product = $this->product->findOrFail($product_id);
        if($product->stock->quantity == 0){
            $this->product->destroy($product_id);
        }

        return back();
    }

    
}
