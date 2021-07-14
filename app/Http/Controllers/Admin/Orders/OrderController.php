<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Fare;
use DB;
class OrderController extends Controller
{
    public function index(Request $request)
    {
    	$orders = Order::latest()->paginate(10);
    	$sum = Order::sum('ride_fare');
    	$ride = Order::where('parent_id', null)->count();
    	$revenue = Fare::pluck('willgo_commission')->first();

    	return view('admin.orders.index', compact('orders', 'sum', 'revenue', 'ride'));    	
    }

    public function search(Request $request)
    {
    	$fromDate = date('Y-m-d 00:00:00', strtotime($request->from_date));
    	$toDate = date('Y-m-d 23:59:59', strtotime($request->from_to));
    	$logs = Order::whereBetween('created_at', array($fromDate, $toDate))->get(); 

    	$pluck 		 = Order::whereBetween('created_at', array($fromDate, $toDate))->pluck('ride_fare')->sum();
    	$searchRide 	 = Order::whereBetween('created_at', array($fromDate, $toDate))->where('parent_id', null)->count();
    	$searchrevenue = Fare::pluck('willgo_commission')->first();
    	$searchOrder = Order::whereBetween('created_at', array($fromDate, $toDate))->count();	
    	return view('admin.orders.index', compact('logs', 'pluck', 'searchRide', 'searchOrder', 'searchrevenue'));
    }
}