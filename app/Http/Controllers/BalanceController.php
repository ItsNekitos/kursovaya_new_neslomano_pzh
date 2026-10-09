<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{
    public function balance_create()
    {
        $balance = new Balance();
        $balance->user_id = Auth::user()->id;
        $balance->balance = 0.00;
        $balance->save();
        return response()->json([
            "success" => true,
            "message" => "Success",
            "balance_id" => $balance->id,
        ], 200);
    }
    public function balance_view($balance_id)
    {
        $balance = Balance::where('id', $balance_id)->first();
        return response()->json([
            "success" => true,
            "message" => "Success",
            "balance_id" => $balance->id,
            "balance"=>$balance->balance,
        ], 200);
    }
    public function balance_delete($balance_id)
    {
        $balance = Balance::where('id', $balance_id);
        $balance->delete();
        return response()->json([
            "success" => true,
            "message" => "Success",
        ], 200);
    }
}
