<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function category_create(StoreCategoryRequest $request)
    {
        if (Auth::user()->role == "admin") {
            $category = new Category();
            $category->name = $request->name;
            $category->platezh = $request->platezh;
            $category->save();
            return response()->json([
                "success" => true,
                "message" => "Success",
                "category_id" => $category->id,
            ], 200);
        } else {
            return response()->json([
                "message" => 'You not admin',
            ], 403);
        }
    }
    public function category_view($category_id)
    {
        if (Auth::user()->role == "admin") {
            $category = Category::where('id', $category_id)->first();
            if (!$category) {
                return response()->json(['success' => false, 'error' => 'Такой категории не существует.'], 422);
            }
            return response()->json([
                "success" => true,
                "message" => "Success",
                "category_id" => $category->id,
                "name" => $category->name,
                "platezh" => $category->platezh,
            ], 200);
        } else {
            return response()->json([
                "message" => 'You not admin',
            ], 403);
        }
    }
    public function category_update(CategoryUpdateRequest $request, $category_id)
    {
        if (Auth::user()->role == "admin") {
            $category = Category::where('id', $category_id)->first();
            $category->name = $request->name;
            $category->platezh = $request->platezh;
            $category->save();
            return response()->json([
                "success" => true,
                "message" => "Success",
                "category_id" => $category->id,
            ], 200);
        } else {
            return response()->json([
                "message" => 'You not admin',
            ], 403);
        }
    }
    public function category_delete($category_id)
    {
        if (Auth::user()->role == "admin") {
            $category = Category::where('id', $category_id)->first();
            if (!$category) {
                return response()->json(['success' => false, 'error' => 'Такой категории не существует.'], 422);
            } else {
                $category->delete();
                return response()->json([
                    "success" => true,
                    "message" => "Success",
                ], 200);
            }
        } else {
            return response()->json([
                "message" => 'You not admin',
            ], 403);
        }
    }
}
