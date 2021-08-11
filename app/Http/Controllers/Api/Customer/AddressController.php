<?php

namespace App\Http\Controllers\api\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Address;
use Auth;
use Validator;
use Carbon\Carbon;
use DB;

class AddressController extends Controller
{
    public function getUserAddress()
    {
        $address = Address::where('user_id', Auth::user()->id)->get();
        if (!$address) {
            return response()->json(["status" => 0, "message" => 'Your Address List Is Empty', "data" => []]);
        }
        return response()->json(["status" => 1, "message" => 'User Address', "data" => $address]);
    }

    public function store(Request $request)
    {
        $rules = [
            'address' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $arr = array(
            'user_id' => Auth::user()->id,
            'address' => $request->address
        );


        $address = Address::create($arr);
        return response()->json(["status" => 1, "message" => 'Address Save Succesfully', "data" => [$address]]);
    }

    public function update(Request $request, $id)
    {
        $address = Address::find($id);
        $rules = [
            'address' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return response()->json(['errors' => $validator->errors()]);
        }

        $arr = array(
            'user_id' => Auth::user()->id,
            'address' => $request->address
        );

        $address->update($arr);

        if ($address) {
            return response()->json(["status" => 1, "message" => 'Updated Save Succesfully', "data" => [$address]]);
        }
    }
}
