<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
class CategoryController extends Controller
{
    private $category;
    private $product;
    
    public function __construct(Category $category, Product $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function index()
    {
        $all_categories = $this->category->latest()->paginate(5);
        $largest_product_count = $this->getLargestProductCount();
        $largest_product_name = $this->getLargestProductName();
        $least_product = $this->getLeastProduct();

        return view('categories.index')->with('all_categories', $all_categories)
                        ->with('largest_product_count', $largest_product_count)
                        ->with('largest_product_name', $largest_product_name)
                        ->with('least_product', $least_product);
    }

    public function store(Request $request)
    {
        $this->category->name = ucfirst($request->name);
        $this->category->user_id = Auth::user()->id;
        $this->category->save();

        return back();
    }

    public function getLargestProductCount()
    {
        $all_categories = $this->category->all();
        $largest = 0;
        foreach($all_categories as $category){
            $product_number = $category->categoryProduct()->count();
            if($product_number > $largest){
                $largest = $product_number;
            }
        }

        return $largest;
    }

    public function getLargestProductName()
    {
        $all_categories = $this->category->all();
        $largest = 0;
        $largest_name = '';

        foreach($all_categories as $category){
            $product_number = $category->categoryProduct()->count();
            if($product_number > $largest){
                $largest = $product_number;
                $largest_name = $category->name;
            }
        }

        return $largest_name;
    }

    public function getLeastProduct()
    {
        $all_categories = $this->category->all();
        $least_product_name = '';
        $least_product_count = null;
        
        foreach($all_categories as $category){
            $product_number = $category->categoryProduct()->count();
            if($least_product_count === null || $product_number < $least_product_count){
                $least_product_count = $product_number;
                $least_product_name = $category->name;
            }
        }

       
        return [
            'least_product_count' => $least_product_count,
            'least_product_name' => $least_product_name
        ];
    }
}
