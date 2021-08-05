<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Shops;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Validator;
use App\Product;
use Auth;

class ProductController extends Controller
{
     public function index(Request $request)
    {
        if (Auth::user()->hasRole('Admin')) {
            $products = Product::latest()->paginate(10);
        } else {
            $products = Product::where('user_id', Auth::user()->id)->paginate(10);
        }
        return view('admin.product.index',compact('products'));
    }

    public function create()
    {
        $shops = Shops::orderBy('id', 'desc')->get();
        return view('admin.product.create',compact('shops'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'category' => 'required',
            'price' => 'required'
        ]);

        $crimage = $request->file('image');
        $img = rand().'.'. $crimage->getClientOriginalExtension();
        $crimage->move(public_path('assets/admin/img/products/'), $img);

        $input = $request->all();
        $input['image'] = $img;
        $input['user_id'] = Auth::user()->id;

        Product::create($input);

        Toastr::success('Product created successfully.', 'Success');
        return redirect()->route('product.index');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $shops = Shops::orderBy('id', 'desc')->get();
        return view('admin.product.edit',compact('product','shops'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $this->validate($request, [
            'name' => 'required',
            'category' => 'required',
            'price' => 'required'
        ]);

        if($request->hasFile('image')) {
            $crimage = $request->file('image');
            $img = rand().'.'. $crimage->getClientOriginalExtension();
            $crimage->move(public_path('assets/admin/img/products/'), $img);
        } else {
            $img = $product->image;
        }


        $product->update([
            'name' => request()->get('name'),
            'category' => request()->get('category'),
            'price' => request()->get('price'),
            'description' => request()->get('description'),
            'user_id' => Auth::user()->id,
            'image' => $img
        ]);

//        dd($product);

        Toastr::success('Product updated successfully.', 'Success');
        return redirect()->route('product.index');
    }

    public function destroy($id)
    {
        Product::find($id)->delete();
        Toastr::success('Product deleted successfully.', 'Success');
        return redirect()->route('product.index');
    }

    public function updateStatus($id)
    {
        $product = Product::find($id);
        $newStatus = ($product->status == 0) ? 1 : 0;
        $product->status = $newStatus;
        $product->save();
        Toastr::success('Status updated successfully.', 'Success');
        return redirect()->back();
    }
}
