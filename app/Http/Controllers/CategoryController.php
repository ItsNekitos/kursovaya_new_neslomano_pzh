<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoriesHome()
    {
        return Category::all();
    }
    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->category_name;
        $category->platezh = $request->platezh;
        $category->save(); 
        return response()->json(['message' => 'ok']);
    }
}
