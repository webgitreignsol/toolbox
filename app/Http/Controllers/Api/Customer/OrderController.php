<?php

namespace App\Http\Controllers\api\customer;

use App\Http\Controllers\Controller;
use App\OrdersItem;
use App\Product;
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
    use ApiResponse;

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

    public function OrderProceed(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product' => 'required|array',
            'product.*.product_id' => 'required|exists:product,id',
            'product.*.qty' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->apiErrorMessageResponse($validator->errors());
        }

        $user_id = Auth::user()->id;
        $vat = 5;
        $sub_total = 45;

        $order = new Orders();
        $order->user_id = $user_id;
        $order->order_date = date('Y-m-d H:i:s');
        $order->customer_id = Auth::user()->id;
        $order->status = 'Order in Process';
        $order->sub_total = $sub_total;
        $order->vat = $vat;
        $order->grand_total = $sub_total + $vat;
        $order->paid_amount = $sub_total + $vat;
        $order->save();



        $add_order_item = [];

        foreach ($request->product as $key => $value) {
            $products = explode(',',$value['product_id']);
            foreach ($products as $k => $v) {
                $product = Product::find($v);
                if($product) {
                    $orderItem = new OrdersItem();
                    $orderItem->order_id = $order->id;
                    $orderItem->product_id = $v;
                    $orderItem->qty = $value['qty'];
                    $orderItem->price = $product->price;
                    $orderItem->total = $product->price * $value['qty'];
                    $orderItem->save();


                    $add_order_item[] = $orderItem;
                }
            }
        }

        return response()->json([
            'status' => 1,
            'message' => 'Order has been Proceed successfully',
            'data' => $add_order_item
        ]);
    }
}
