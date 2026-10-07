<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionCreateRequest;
use App\Models\Transactions;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function transaction_create(TransactionCreateRequest $request, $category_id, $balance_id)
    {
        $transaction = new Transactions();
        $transaction->category_id = $category_id;
        $transaction->balance_id = $balance_id;
        $transaction->amount = $request->amount;
        $transaction->save();
        return response([
            "success" => true,
            "message" => "Success",
        ]);
    }
}
