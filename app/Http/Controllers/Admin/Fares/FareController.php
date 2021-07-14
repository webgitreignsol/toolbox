<?php

namespace App\Http\Controllers\Admin\Fares;

use App\Fare;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class FareController extends Controller
{
    public function edit()
    {
        $fare = Fare::find(1);
        return view('admin.fare.createUpdate',compact('fare'));
    }

    public function update(Request $request, $id)
    {
        $fare = Fare::find(1);

        $this->validate($request, [
            'per_mile' => 'required',
            'per_minute' => 'required',
        ]);

        $input = $request->all();

        $fare->update($input);

        Toastr::success('Fare updated successfully.', 'Success');
        return redirect()->back();
    }
}
