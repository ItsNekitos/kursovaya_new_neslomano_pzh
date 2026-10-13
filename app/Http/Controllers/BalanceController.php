<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{
    public function balance_create($user)
    {
        if (Auth::user()->role == "admin") {
            if (!User::find($user)) {
                return response()->json(['success' => false, 'error' => 'Такого пользователя не существует.'], 422);
            }
            $balance = new Balance();
            $balance->user_id = $user;
            $balance->balance = 0.00;
            $balance->save();
            return response()->json([
                "success" => true,
                "message" => "Success",
                "balance_id" => $balance->id,
            ], 200);
        } else {
            return response()->json([
                "message" => 'You not admin',
            ], 403);
        }
    }
    public function balance_view($balance_id)
    {
        $balance = Balance::where('id', $balance_id)->first();
        if (!$balance) {
            return response()->json(['success' => false, 'error' => 'Такого баланса не существует.'], 422);
        }
        return response()->json([
            "success" => true,
            "message" => "Success",
            "balance_id" => $balance->id,
            "balance" => $balance->balance,
        ], 200);
    }
    public function balance_delete($balance_id)
    {
        if (Auth::user()->role == "admin") {
            $balance = Balance::where('id', $balance_id)->first();
            if(!$balance){
                return response()->json(['success' => false, 'error' => 'Такого баланса не существует.'], 422);
            }
            $balance->delete();
            return response()->json([
                "success" => true,
                "message" => "Success",
            ], 200);
        } else {
            return response()->json([
                "message" => 'You not admin',
            ], 403);
        }
    }
}
