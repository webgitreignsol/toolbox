<?php

namespace App\Http\Controllers\Admin\Rides;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ride;
use App\Role;

class IndexController extends Controller
{
    public function index()
    {
    	$rides = Ride::latest()->paginate(10);
    	return view('admin.rides.index', compact('rides'));
    }

    public function accepted()
    {
    	$rides = Ride::where('status', 0)->paginate(10);
    	return view('admin.rides.accepted', compact('rides'));
    }

    public function completed()
    {
    	$rides = Ride::where('status', 1)->paginate(10);
    	return view('admin.rides.completed', compact('rides'));
    }

    public function cancelled()
    {
    	$rides = Ride::where('status', 2)->paginate(10);
    	return view('admin.rides.cancelled', compact('rides'));
    }

    public function view($id)
    {
    	$ride = Ride::find($id);
    	return view('admin.rides.view', compact('ride'));
    }
}
