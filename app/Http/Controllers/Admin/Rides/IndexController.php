<?php

namespace App\Http\Controllers\Admin\Rides;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ride;

class IndexController extends Controller
{
    public function index()
    {
    	$rides = Ride::latest()->paginate(10);
    	return view('admin.rides.index', compact('rides'));
    }
}
