<?php

namespace App\Http\Controllers\admin\order;

use App\Http\Controllers\Controller;
use App\Orders;
use Auth;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->hasRole('Admin')) {
            $orders = Orders::latest()->paginate(10);
        } else {
            $orders = Orders::where('user_id', Auth::user()->id)->paginate(10);
        }
        return view('admin.order.index',compact('orders'));
    }
}
