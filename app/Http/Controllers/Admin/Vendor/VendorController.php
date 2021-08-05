<?php

namespace App\Http\Controllers\admin\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Auth;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        $users = User::role('Vendor')->orderBy('id', 'desc')->get();
        return view('admin.vendor.index',compact('users'));
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.vendor.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['added_by'] = Auth::user()->id;

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        Toastr::success('Vendor Manager created successfully.', 'Success');
        return redirect()->route('vendor.index');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('admin.vendor.edit',compact('user','roles','userRole'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input['password'] = $user->password;
        }

        $input['updated_by'] = Auth::user()->id;

        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        Toastr::success('Vendor Manager updated successfully.', 'Success');
        return redirect()->route('vendor.index');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        Toastr::success('Vendor Manager deleted successfully.', 'Success');
        return redirect()->route('vendor.index');
    }
}
