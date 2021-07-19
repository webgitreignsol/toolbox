<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Commission;
use App\Order;
use App\Pets;
class DashboardController extends Controller
{

    public function index()
    {
        $sum = Order::sum('ride_fare');
        $orders = Order::latest()->paginate(10);
        $ride = Order::where('parent_id', null)->count();
        $revenue = Commission::pluck('value')->first();
    	return view ('admin.dashboard.index', compact('orders', 'sum', 'revenue', 'ride'));
    }
}

