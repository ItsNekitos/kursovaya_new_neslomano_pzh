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
        return response([
            "success" => true,
            "message" => "Success",
            "balance_id" => $balance->id,
        ]);
    }
    public function balance_delete($balance_id)
    {
        $balance = Balance::where('balance_id', $balance_id);
        $balance->delete();
        return response([
            "success" => true,
            "message" => "Success",
        ]);
    }
}
