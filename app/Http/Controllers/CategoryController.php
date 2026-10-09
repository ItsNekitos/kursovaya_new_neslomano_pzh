<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryUpdateRequest;
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
        return response()->json([
            "success" => true, "message" => "Success", "category_id" => $category->id,
        ], 200);
    }
    public function category_view($category_id)
    {
        $category = Category::where('id', $category_id)->first();
        return response()->json([
            "success" => true,
            "message" => "Success",
            "category_id" => $category->id,
            "name"=>$category->name,
            "platezh" => $category->platezh,
        ], 200);
    }
    public function category_update(CategoryUpdateRequest $request, $category_id)
    {
        $category = Category::where('id', $category_id)->first();
        $category->name = $request->name;
        $category->platezh = $request->platezh;
        $category->save(); 
        return response()->json([
            "success" => true, "message" => "Success", "category_id" => $category->id,
        ], 200);
    }
    public function category_delete($category_id)
    {
        $category = Category::where('id', $category_id);
        $category->delete();
        return response()->json([
            "success" => true,
            "message" => "Success",
        ], 200);
    }
}
