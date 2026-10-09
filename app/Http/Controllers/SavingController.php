<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavingCreateRequest;
use App\Http\Requests\SavingUpdateRequest;
use App\Models\Balance;
use App\Models\Saving;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavingController extends Controller
{
    public function saving_create(SavingCreateRequest $request)
    {
        $saving = new Saving();
        $saving->user_id = Auth::user()->id;
        $saving->name = $request->name;
        $saving->save_date = $request->save_date;
        $saving->save();
        return response()->json([
            "success" => true,
            "message" => "Success",
            "saving_id" => $saving->id,
        ], 200);
    }
    public function saving_update(SavingUpdateRequest $request, $saving_id)
    {
        $saving = Saving::where('id', $saving_id)->first();
        if (Auth::user()->id == $saving->user_id) {
            $saving->name = $request->name;
            $saving->save_date = $request->save_date;
            $saving->save();
            return response()->json([
                "success" => true,
                "message" => "Success",
                "saving_id" => $saving->id,
            ], 200);
        }
        else{
            return response()->json(["message" => "Не верный пользователь"], 422);
        }
    }
    public function saving_view($saving_id)
    {
        $saving = Saving::where('id', $saving_id)->first();
        return response()->json([
            "success" => true,
            "message" => "Success",
            "saving_id" => $saving->id,
            "name"=>$saving->name,
            "amount" => $saving->save_amount,
            "saving_date"=>$saving->save_date,
        ], 200);
    }
    public function saving_popolneniye(Request $request, $balance_id, $saving_id)
    {
        $balance = Balance::where('id', $balance_id)->first();
        $saving = Saving::where('id', $saving_id)->first();
        $value = $request->value;
        if (Auth::user()->id == $saving->user_id) {
            if ($balance->balance >= $value) {
                $balance->balance = $balance->balance - $value;
                $saving->save_amount = $saving->save_amount + $value;
                $balance->save();
                $saving->save();
                return response()->json([
                    "message" => "Success",
                    'sav' => $saving,
                ]);
            } else {
                return response()->json(["message" => "Не достаточно средств"], 422);
            }
        } else {
            return response()->json(["message" => "Не верный пользователь"], 422);
        }
    }
    public function saving_vivod(Request $request, $balance_id, $saving_id)
    {
        $balance = Balance::where('id', $balance_id)->first();
        $saving = Saving::where('id', $saving_id)->first();
        $value = $request->value;
        if (Auth::user()->id == $saving->user_id) {
            if ($saving->save_amount >= $value) {
                $balance->balance = $balance->balance + $value;
                $saving->save_amount = $saving->save_amount - $value;
                $balance->save();
                $saving->save();
                return response()->json([
                    "message" => "Success",
                    'sav' => $saving,
                ]);
            } else {
                return response()->json(["message" => "Не достаточно средств"], 422);
            }
        } else {
            return response()->json(["message" => "Не верный пользователь"], 422);
        }
    }
    public function saving_delete($saving_id)
    {
        $saving = Saving::where('id', $saving_id);
        $saving->delete();
        return response()->json([
            "success" => true,
            "message" => "Success",
        ], 200);
    }
}
