<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavingCreateRequest;
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
        return response([
            "success" => true,
            "message" => "Success",
            "saving_id" => $saving->id,
        ]);
    }
    public function saving_delete($saving_id)
    {
       $saving = Saving::where('id', $saving_id);
       $saving->delete();
        return response([
            "success" => true,
            "message" => "Success",
        ]);
    }
}
