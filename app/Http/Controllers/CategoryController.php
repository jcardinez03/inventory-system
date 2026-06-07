<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    private $category;
    
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $all_categories = $this->category->latest()->get();

        return view('categories.index')->with('all_categories', $all_categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique'
        ]);

        $this->category->name = $request->name;

        $this->category->save();

        return back();
    }
}
