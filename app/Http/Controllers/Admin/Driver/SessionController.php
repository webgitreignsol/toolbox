<?php

namespace App\Http\Controllers\Admin\Driver;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\DriverSession;

class SessionController extends Controller
{
    public function index()
    {
    	$sessions = DriverSession::latest()->paginate(10);
    	return view('admin.drivers.sessions', compact('sessions'));	
    }

    public function edit($id)
    {
    	$session = DriverSession::find($id);
    	return view('admin.drivers.editsessions', compact('session'));	
    }

    public function update(Request $request, $id)
    {
    	$session = DriverSession::find($id);
    	$session->start_time = $request->start_time;
    	$session->end_time = $request->end_time;
    	$session->status = $request->status;
    	$session->save();
    	Toastr::success('Driver created successfully.', 'Success');
    	return redirect()->route('drivers.session');	
    }
}
