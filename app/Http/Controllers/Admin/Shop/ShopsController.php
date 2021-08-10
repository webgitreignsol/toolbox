<?php

namespace App\Http\Controllers\admin\shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Validator;
use App\Shops;
use Auth;
use File;

class ShopsController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->hasRole('Admin')) {
            $shops = Shops::latest()->paginate(10);
        } else {
            $shops = Shops::where('user_id', Auth::user()->id)->paginate(10);
        }
        return view('admin.shop.index',compact('shops'));
    }

    public function create()
    {
        return view('admin.shop.create');
    }

    public function updateApproval($id) {
        $shop = Shops::find($id);
        $newStatus = ($shop->approve == 'No') ? 'Yes' : 'No';
        $shop->approve = $newStatus;
        $shop->save();
        Toastr::success('Shop updated successfully.', 'Success');
        return redirect()->back();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $crimage = $request->file('image');
        $img = rand().'.'. $crimage->getClientOriginalExtension();
        $crimage->move(public_path('assets/admin/img/shops/'), $img);

        $input = $request->all();
        $input['image'] = $img;
        $input['user_id'] = Auth::user()->id;

        Shops::create($input);

        Toastr::success('Shop created successfully.', 'Success');
        return redirect()->route('shop.index');
    }

    public function edit($id)
    {
        $shop = Shops::find($id);
        return view('admin.shop.edit',compact('shop'));
    }

    public function update(Request $request, $id)
    {
        $shop = Shops::find($id);

        $this->validate($request, [
            'name' => 'required'
        ]);

        if($request->hasFile('image')) {
            $crimage = $request->file('image');
            $img = rand().'.'. $crimage->getClientOriginalExtension();
            $crimage->move(public_path('assets/admin/img/shops/'), $img);
        } else {
            $img = $shop->image;
        }

        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $input['image'] = $img;
        $shop->update($input);


        Toastr::success('Shop updated successfully.', 'Success');
        return redirect()->route('shop.index');
    }

    public function destroy($id)
    {
        $shops = Shops::find($id);
        $image = $shops->image;
        $shops->delete();
        File::delete(public_path('assets/admin/img/shops/').$image);
        Toastr::success('Shop deleted successfully.', 'Success');
        return redirect()->route('shop.index');
    }

    public function updateStatus($id)
    {
        $shop = Shops::find($id);
        $newStatus = ($shop->status == 0) ? 1 : 0;
        $shop->status = $newStatus;
        $shop->save();
        Toastr::success('Status updated successfully.', 'Success');
        return redirect()->back();
    }
}
