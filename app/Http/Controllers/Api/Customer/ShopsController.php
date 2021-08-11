<?php

namespace App\Http\Controllers\api\customer;

use App\Http\Controllers\Controller;
use App\ShopRating;
use App\Shops;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Carbon\Carbon;
use DB;

class ShopsController extends Controller
{

    public function getAllShops()
    {
        $records = Shops::orderBy('created_at', 'desc')->get();

        if (!$records) {
            return response()->json(["status" => 0, "message" => 'No Record Found', "data" => []]);
        }else{
            return response()->json(["status" => 1, "message" => 'All Shops', "data" => $records]);
        }
    }

    public function ShopRating(Request $request)
    {
        $arr = array(
            'shop_id' => $request->shop_id,
            'reviewed_by' => Auth::user()->id,
            'rating' => $request->rating,
            'comments' => $request->comments
        );

        $rating = ShopRating::create($arr);
        return response()->json(["status" => 1, "message" => 'Rating Save Succesfully', "data" => [$rating]]);
    }
}
