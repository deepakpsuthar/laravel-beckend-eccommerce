<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\DataTables\CategoriesDataTable;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoriesDataTable $dataTable)
    {
        abort_if(!auth()->user()->can('view category'),403);

      return $dataTable->render('admin.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('add category'),403);

      return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('add category'),403);

        $request->validate([
            'name' => 'required|min:2',
            'alias'=> 'required|unique:categories,alias',
        ]);

        $category = new Category();
        $category->name = $request->get('name');
        $category->alias = $request->get('alias');
        $category->status = ($request->get('status')) ? $request->get('status') : 1;
        $category->description = $request->get('description');

        if($request->hasfile('image'))
        {
            $category->image = uploadFile($request,'image','categories');
        }
        $category->save();

        return redirect()->route('admin.categories.index')->with('success','item added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(!auth()->user()->can('view category'),403);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        abort_if(!auth()->user()->can('edit category'),403);

        return view('admin.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        abort_if(!auth()->user()->can('edit category'),403);

        $request->validate([
            'name' => 'required|min:2',
            'alias'=> 'required|unique:categories,alias,'.$category->id,
        ]);

        $category->name = $request->get('name');
        $category->alias = $request->get('alias');
        $category->status = ($request->get('status')) ? $request->get('status') : 1;
        $category->description = $request->get('description');
        if($request->hasfile('image'))
        {
            $category->image = uploadFile($request,'image','categories');

            if($category->image && !empty($request->get('old_image')) && file_exists($request->get('old_image'))){
                unlink($request->get('old_image'));
            }
        }
        $category->save();

        return redirect()->route('admin.categories.index')->with('success','item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        abort_if(!auth()->user()->can('delete category'),403);

        $category->delete();
        return response()->json([
            'status' => 'true',
            'message' => 'item deleted successfully'
        ], 200);
    }
}
