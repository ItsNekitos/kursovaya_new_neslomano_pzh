<?php

namespace App\Http\Controllers;

use App\Http\Requests\LimitCreateRequest;
use App\Models\Limit;
use Illuminate\Http\Request;

class LimitController extends Controller
{
    public function limit_create(LimitCreateRequest $request, $balance_id, $category_id)
    {
        $saving = new Limit();
        $saving->balance_id = $balance_id;
        $saving->category_id = $category_id;
        $saving->max_summ = $request->max_summ;
        $saving->rashod_limit_date = $request->rashod_limit_date;
        $saving->save();
        return response([
            "success" => true,
            "message" => "Success",
        ]);
    }
    // public function destroy($recipeid)
    // {
    //    $favorites = Favorite::where('recipe_id', $recipeid)->where('user_id', Auth::user()->id);
    //    return $favorites->delete();
    // }
}
