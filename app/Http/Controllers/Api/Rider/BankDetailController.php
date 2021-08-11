<?php

namespace App\Http\Controllers\api\rider;

use App\BankDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;
use App\Classes\Helper;
use Validator;
use App\User;
use App\UserProfile;
use Auth;
use Carbon\Carbon;
use DB;

class BankDetailController extends Controller
{
    use ApiResponse;


    public function getBankDetail(Request $request)
    {
        $detail = BankDetail::where('user_id', Auth::user()->id)->first();

        if ($detail) {
            return response()->json(["status" => 1, "message" => 'Your Bank Detail', "data" => $detail]);
        } else {
            return response()->json(["status" => 0, "message" => 'You Bank Detail Is Empty', "data" => []]);
        }
    }


    public function updateBankDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'bank_name' => 'required',
            'account_number' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => 0, "message" => 'Please Filled All Fields', "data" => $validator->errors()]);
        }
            $detail = BankDetail::where('user_id', Auth::user()->id)->first();
            if ($detail) {
                $detail->name = $request->name;
                $detail->bank_name = $request->bank_name;
                $detail->account_number = $request->account_number;
                $detail->save();
            } else {
                $detail = new BankDetail();
                $detail->name = $request->name;
                $detail->bank_name = $request->bank_name;
                $detail->account_number = $request->account_number;
                $detail->user_id = \Auth::user()->id;
                $detail->save();
            }

        return response()->json(["status" => 1, "message" => 'Your Bank Detail', "data" => $detail]);
    }
}
