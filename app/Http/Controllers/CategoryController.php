<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

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
            'name' => 'required'
        ]);

        $this->category->name = ucfirst($request->name);
        $this->category->user_id = Auth::user()->id;
        $this->category->save();

        return back();
    }
}
