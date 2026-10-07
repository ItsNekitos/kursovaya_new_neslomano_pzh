<?php

namespace App\Http\Controllers;

use App\Http\Requests\LimitCreateRequest;
use App\Models\Limit;
use Illuminate\Http\Request;

class LimitController extends Controller
{
    public function limit_create(LimitCreateRequest $request, $balance_id, $category_id)
    {
        $limit = new Limit();
        $limit->balance_id = $balance_id;
        $limit->category_id = $category_id;
        $limit->max_summ = $request->max_summ;
        $limit->rashod_limit_date = $request->rashod_limit_date;
        $limit->save();
        return response([
            "success" => true,
            "message" => "Success",
        ]);
    }
    public function limit_delete($balance_id, $category_id)
    {
       $limit = Limit::where('balance_id', $balance_id)->where('category_id', $category_id);
       $limit->delete();
        return response([
            "success" => true,
            "message" => "Success",
        ]);
    }
}