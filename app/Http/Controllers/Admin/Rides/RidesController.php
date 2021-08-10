<?php

namespace App\Http\Controllers\admin\rides;

use App\Http\Controllers\Controller;
use App\Rides;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Auth;

class RidesController extends Controller
{
    public function cancelled()
    {
        $rides = Rides::where('status', 'cancelled')->paginate(10);
        return view('admin.rides.cancelled', compact('rides'));
    }

    public function started()
    {
        $rides = Rides::where('status', 'started')->paginate(10);
        return view('admin.rides.started', compact('rides'));
    }

    public function completed()
    {
        $rides = Rides::where('status', 'completed')->paginate(10);
        return view('admin.rides.completed', compact('rides'));
    }
}
