<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionCreateRequest;
use App\Models\Balance;
use App\Models\Category;
use App\Models\Limit;
use App\Models\Transactions;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function transaction_create(TransactionCreateRequest $request, $category_id, $balance_id)
    {
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
            return response([
                "success" => true,
                "message" => "no",
            ]);
        }

        return response([
            "success" => true,
            "message" => "Success",
            "category" => $category_id,
            "platezh" => $category->platezh,
            "balance_id" => $balance->id,
            "balance_dengi" => $balance->balance,
        ]);
    }
}
