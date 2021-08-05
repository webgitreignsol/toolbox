<?php

namespace App\Http\Controllers\admin\rider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Auth;

class RiderController extends Controller
{
    public function index(Request $request)
    {
        $users = User::role('Rider')->orderBy('id', 'desc')->get();
        return view('admin.rider.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.rider.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        Toastr::success('Rider created successfully.', 'Success');
        return redirect()->route('rider.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('admin.rider.edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        Toastr::success('Rider updated successfully.', 'Success');
        return redirect()->route('rider.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        Toastr::success('Rider deleted successfully.', 'Success');
        return redirect()->route('rider.index');
    }

    public function updateApproval($id) {
        $user = User::find($id);
        $newStatus = ($user->approve == 'No') ? 'Yes' : 'No';
        $user->approve = $newStatus;
        $user->save();
        Toastr::success('Rider updated successfully.', 'Success');
        return redirect()->back();
    }

    public function updateStatus($id)
    {
        $user = User::find($id);
        $newStatus = ($user->status == 0) ? 1 : 0;
        $user->status = $newStatus;
        $user->save();
        Toastr::success('Status updated successfully.', 'Success');
        return redirect()->back();
    }
}
