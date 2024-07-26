<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\DataTables\ProductsDataTable;
class ProductController extends Controller
{
    public function index(ProductsDataTable $dataTable)
    {
        abort_if(!auth()->user()->can('view product'),403);

        return $dataTable->render('admin.products.index');
    }

    public function create()
    {
        abort_if(!auth()->user()->can('add product'),403);

        $categories = Category::where('status','1')->get()->pluck('id','name');

        return view('admin.products.create',compact('categories'));
    }

    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('add product'),403);

        $request->validate([
            'name' => 'required|min:2',
            'alias'=> 'required|unique:products,alias',
            'price'=> 'required',
            'category_id'=> 'required',
            'short_desc'=> 'required',
        ]);

        $product = new Product();
        $product->name = $request->get('name');
        $product->alias = $request->get('alias');
        $product->status = ($request->get('status')) ? $request->get('status') : 1;
        $product->price = $request->get('price');
        $product->category_id = $request->get('category_id');
        $product->short_desc = $request->get('short_desc');
        $product->desc = $request->get('desc');
        $product->user_id =auth()->user()->id;

        if($request->hasfile('image'))
        {
            $product->image = uploadFile($request,'image','products');
        }
        $product->save();
        return redirect()->route('admin.products.index')->with('success','item added successfully');

    }

    public function show(string $id)
    {
        //
    }

    public function edit(Product $product)
    {
        abort_if(!auth()->user()->can('edit product'),403);

        $categories = Category::where('status','1')->get()->pluck('id','name');

        return view('admin.products.edit',compact('product','categories'));

    }


    public function update(Request $request, Product $product)
    {
        abort_if(!auth()->user()->can('edit product'),403);

        $request->validate([
            'name' => 'required|min:2',
            'alias'=> 'required|unique:products,alias,'.$product->id,
            'price'=> 'required',
            'category_id'=> 'required',
            'short_desc'=> 'required',
        ]);
        $product->name = $request->get('name');
        $product->alias = $request->get('alias');
        $product->status = ($request->get('status')) ? $request->get('status') : 1;
        $product->price = $request->get('price');
        $product->category_id = $request->get('category_id');
        $product->short_desc = $request->get('short_desc');
        $product->desc = $request->get('desc');
        $product->user_id =auth()->user()->id;

        if($request->hasfile('image'))
        {
            $product->image = uploadFile($request,'image','products');

            if($product->image && !empty($request->get('old_image')) && file_exists($request->get('old_image'))){
                unlink($request->get('old_image'));
            }
        }
        $product->save();

        return redirect()->route('admin.products.index')->with('success','item updated successfully');
    }


    public function destroy(Product $product)
    {
        abort_if(!auth()->user()->can('delete product'),403);

        $product->delete();
        return response()->json([
            'status' => 'true',
            'message' => 'item deleted successfully'
        ], 200);
    }
}
