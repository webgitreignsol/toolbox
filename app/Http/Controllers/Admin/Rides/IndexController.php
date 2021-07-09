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

    public function view($id)
    {
    	$ride = Ride::find($id);
    	return view('admin.rides.view', compact('ride'));    }
}
