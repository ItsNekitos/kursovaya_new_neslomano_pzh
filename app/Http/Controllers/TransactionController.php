<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionCreateRequest;
use App\Models\Balance;
use App\Models\Category;
use App\Models\Limit;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function transaction_create(TransactionCreateRequest $request, $category_id, $balance_id)
    {
        if (Auth::user()->role == "admin") {
            $transaction = new Transactions();
            $balance = Balance::where('id', $balance_id)->first();
            $category = Category::where('id', $category_id)->first();

            $transaction->category_id = $category_id;
            $transaction->balance_id = $balance_id;
            $transaction->amount = $request->amount;
            $transaction->save();

            if ($category->platezh == 'rashod') {
                $balance->balance = $balance->balance - $transaction->amount;
                $balance->save();
            } elseif ($category->platezh == 'dohod') {
                $balance->balance = $balance->balance + $transaction->amount;
                $balance->save();
            } else {
                return response()->json([
                    "success" => true,
                    "message" => "no",
                ], 422);
            }
            return response()->json([
                "success" => true,
                "message" => "Success",
                "category" => $category_id,
                "platezh" => $category->platezh,
                "balance_id" => $balance->id,
                "balance_dengi" => $balance->balance,
            ], 200);
        } else {
            return response()->json([
                "message" => 'You not admin',
            ], 403);
        }
    }
    public function transaction_view($transaction_id)
    {
        if (Auth::user()->role == "admin") {
            $transaction = Transactions::where('id', $transaction_id)->first();
            if (!$transaction) {
                return response()->json(['success' => false, 'error' => 'Такой транзакции не существует.'], 422);
            }
            return response()->json([
                "success" => true,
                "message" => "Success",
                "transaction_id" => $transaction->id,
                "amount" => $transaction->amount,
                "balance_id" => $transaction->balance_id,
                "category"=>$transaction->category
            ], 200);
        } else {
            return response()->json([
                "message" => 'You not admin',
            ], 403);
        }
    }
}
