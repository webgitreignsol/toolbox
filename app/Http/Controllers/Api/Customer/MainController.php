<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rating;
use App\Trip;

class MainController extends Controller
{
    public function getAlltrips()
    {
    	$trips = Trip::latest()->paginate(10);
    	return response()->json(["status" => 1, "message" => 'Customer Trips', "data" => $trips]);       
    }

    public function ratings()
    {
    	//
    	// return response()->json(["status" => 1, "message" => 'Customer Trips', "data" => $trips]);       
    }
}
