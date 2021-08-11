<?php

namespace App\Http\Controllers\api\customer;

use App\Http\Controllers\Controller;
use App\Wishlist;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Carbon\Carbon;
use DB;

class WishlistController extends Controller
{
    public function getWishlist()
    {
        $wishlist = Wishlist::with('product' )->where('user_id', Auth::user()->id)->get();
        if (!$wishlist){
            return response()->json(["status" => 0, "message" => 'Your Wishlist Is Empty', "data" => []]);
        }
        return response()->json(["status" => 1, "message" => 'Your Wishlist', "data" => $wishlist]);
    }

    public function store(Request $request)
    {
        $arr = array(
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id
        );

        $wishlist = Wishlist::create($arr);
        return response()->json(["status" => 1, "message" => 'Wishlist Save Succesfully', "data" => [$wishlist]]);
    }

    public function removeWishlist($id)
    {
        Wishlist::find($id)->delete();
        return response()->json(["status" => 1, "message" => 'Wishlist Remove Succesfully', "data" => []]);
    }
}
