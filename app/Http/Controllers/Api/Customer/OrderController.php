<?php

namespace App\Http\Controllers\api\customer;

use App\Http\Controllers\Controller;
use App\OrdersItem;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;
use Validator;
use App\User;
use App\UserProfile;
use Auth;
use Carbon\Carbon;
use App\Orders;
use DB;

class OrderController extends Controller
{
    public function getProcessOrders()
    {
        $records = OrdersItem::with('order','product' )->whereHas('order', function($q) {
            $q->where('user_id', auth()->user()->id)->where('status', 'Order In Process');
        })->orderBy('created_at', 'desc')->get();
        if (!$records) {
            return response()->json(["status" => 0, "message" => 'No Record Found', "data" => []]);
        }else{
            return response()->json(["status" => 1, "message" => 'Orders In Process', "data" => $records]);
        }
    }

    public function getDeliveredOrders()
    {
        $records = OrdersItem::with('order','product' )->whereHas('order', function($q) {
            $q->where('user_id', auth()->user()->id)->where('status', 'Order Delivered');
        })->orderBy('created_at', 'desc')->get();
        if (!$records) {
            return response()->json(["status" => 0, "message" => 'No Record Found', "data" => []]);
        }else{
            return response()->json(["status" => 1, "message" => 'Orders Delivered', "data" => $records]);
        }
    }
}
