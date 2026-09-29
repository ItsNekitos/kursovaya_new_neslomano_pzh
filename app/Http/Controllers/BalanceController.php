<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{
    public function blance_create(){
        $balance = new Balance();
        $balance->user_id = Auth::user();
        $balance->balance = 0.00;
        $balance->save(); 
        return response()->json(['message' => 'ok']);
    }
}
