<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\Ride;
use App\Commission;
use DB;
class OrderController extends Controller
{
    public function index(Request $request)
    {
    	$orders = Order::latest()->paginate(10);
    	$sum = Order::sum('ride_fare');
    	$ride = Order::where('parent_id', null)->count();
    	$revenue = Commission::pluck('value')->first();

    	return view('admin.orders.index', compact('orders', 'sum', 'revenue', 'ride'));
    }

    public function search(Request $request)
    {
    	$fromDate = date('Y-m-d 00:00:00', strtotime($request->from_date));
    	$toDate = date('Y-m-d 23:59:59', strtotime($request->from_to));
    	$logs = Order::whereBetween('created_at', array($fromDate, $toDate))->get();
//        dd($logs);
    	$pluck 		 = Order::whereBetween('created_at', array($fromDate, $toDate))->pluck('ride_fare')->sum();
    	$searchRide 	 = Order::whereBetween('created_at', array($fromDate, $toDate))->where('parent_id', null)->count();
    	$searchrevenue = Commission::pluck('value')->first();
    	$searchOrder = Order::whereBetween('created_at', array($fromDate, $toDate))->count();
    	return view('admin.orders.index', compact('logs', 'pluck', 'searchRide', 'searchOrder', 'searchrevenue'));
    }

    public function edit($id)
    {
        $order = Order::find($id);
        $users = User::orderBy('id', 'desc')->get();
        $rides = Ride::get();

        return view('admin.orders.edit',compact('order','rides','users'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        $this->validate($request, [
            'passenger_id' => 'required',
            'driver_id' => 'required',
            'ride_fare' => 'required',
            'taxes' => 'required',
            'type' => 'required'
        ]);

        $order->update([
            'ride_fare' => $request->ride_fare,
            'taxes' => $request->taxes,
            'driver_id' => $request->driver_id,
            'passenger_id' => $request->passenger_id,
            'parent_id' => $request->parent_id,
            'type' => $request->type,
        ]);

        Toastr::success('Order updated successfully.', 'Success');
        return redirect()->route('reports.index');
    }
}
