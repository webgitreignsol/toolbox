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
    	return view ('admin.dashboard.index');
    }
}

