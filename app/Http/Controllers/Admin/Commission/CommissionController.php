<?php

namespace App\Http\Controllers\admin\Commission;

use App\Http\Controllers\Controller;
use App\Commission;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    public function edit()
    {
        $commission = Commission::find(1);
        return view('admin.commission.createUpdate',compact('commission'));
    }

    public function update(Request $request, $id)
    {
        $commission = Commission::find(1);

        $this->validate($request, [
            'value' => 'required',
            'percent' => 'required',
        ]);

        $input = $request->all();

        $commission->update($input);

        Toastr::success('Commission updated successfully.', 'Success');
        return redirect()->back();
    }
}
