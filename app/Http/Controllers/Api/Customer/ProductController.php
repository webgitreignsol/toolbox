<?php

namespace App\Http\Controllers\api\customer;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductRating;
use App\ShopRating;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Carbon\Carbon;
use DB;

class ProductController extends Controller
{
    public function getAllProducts()
    {
        $records = Product::with('shops' )->orderBy('created_at', 'desc')->get();

        if (!$records) {
            return response()->json(["status" => 0, "message" => 'No Record Found', "data" => []]);
        }else{
            return response()->json(["status" => 1, "message" => 'All Products', "data" => $records]);
        }
    }

    public function search(Request $request)
    {
        $category = $request->category;
        $lowest = $request->lowest_price;
        $highest = $request->highest_price;
        if ($category) {
            $pluck = Product::with('shops' )->whereBetween('price', array($lowest, $highest))->where('category', array($category))->get();
        } else {
            $pluck = Product::with('shops' )->whereBetween('price', array($lowest, $highest))->get();
        }
        if (!$pluck) {
            return response()->json(["status" => 0, "message" => 'No Record Found', "data" => []]);
        }else{
            return response()->json(["status" => 1, "message" => 'All Products', "data" => $pluck]);
        }
    }


    public function ProductRating(Request $request)
    {
        $arr = array(
            'product_id' => $request->product_id,
            'reviewed_by' => Auth::user()->id,
            'rating' => $request->rating,
            'comments' => $request->comments
        );

        $rating = ProductRating::create($arr);
        return response()->json(["status" => 1, "message" => 'Rating Save Succesfully', "data" => [$rating]]);
    }
}
