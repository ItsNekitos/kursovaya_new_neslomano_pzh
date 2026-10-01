<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category_create(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->platezh = $request->platezh;
        $category->save(); 
        return response([
            "success" => true, "message" => "Success", "category_id" => $category->id,
        ]);
    }
}
