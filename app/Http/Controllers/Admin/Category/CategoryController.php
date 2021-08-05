<?php

namespace App\Http\Controllers\admin\category;

use App\Http\Controllers\Controller;
use App\Category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Validator;
use Auth;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->hasRole('Admin')) {
            $categories = Category::latest()->paginate(10);
        } else {
            $categories = Category::where('user_id', Auth::user()->id)->paginate(10);
        }
        return view('admin.category.index',compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $input = $request->all();
        $input['user_id'] = Auth::user()->id;

        Category::create($input);

        Toastr::success('Category created successfully.', 'Success');
        return redirect()->route('category.index');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        $this->validate($request, [
            'name' => 'required'
        ]);

        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $category->update($input);

        Toastr::success('Category updated successfully.', 'Success');
        return redirect()->route('category.index');
    }

    public function destroy($id)
    {
        Category::find($id)->delete();
        Toastr::success('Category deleted successfully.', 'Success');
        return redirect()->route('category.index');
    }
}
