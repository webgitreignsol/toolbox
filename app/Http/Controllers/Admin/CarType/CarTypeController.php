<?php

namespace App\Http\Controllers\admin\CarType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use App\CarType;


class CarTypeController extends Controller
{
    public function index(Request $request)
    {
        $types = CarType::orderBy('id', 'desc')->get();
        return view('admin.car_type.index',compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.car_type.create');
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
            'description' => 'required'
        ]);

        $input = $request->all();

        CarType::create($input);

        Toastr::success('Car Type created successfully.', 'Success');
        return redirect()->route('car.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $types = CarType::find($id);
        return view('admin.car_type.edit',compact('types'));
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
        $types = CarType::find($id);

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        $input = $request->all();
        $types->update($input);

        Toastr::success('Car Type updated successfully.', 'Success');
        return redirect()->route('car.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CarType::find($id)->delete();
        Toastr::success('Car Type deleted successfully.', 'Success');
        return redirect()->route('car.index');
    }
}
