<?php

namespace App\Http\Controllers\backend;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\backend\Category;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('backend.category.index');
    }

    public function categoryShow(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-sm edit_modal" data-toggle="modal" data-target="#update_category_modal">Edit</a>
                    <a href="' . route('category.delete', [$row->id]) . '" class="btn btn-danger btn-sm" id="category_delete">Delete</a>';                    
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    // store method for category insert
    public function store(Request $request)
    {
        $validate = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->category_slug = Str::slug($request->category_name, '-');
        $category->save();
        return response()->json(['add_new_category' => 'New Category Successfully inserted']);
    }

    //   edit method for edit category
    public function edit($id)
    {
        $data = Category::find($id);

        return response()->json($data);
    }

    //   update method for update category
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->category_name = $request->category_name;
        $category->category_slug = Str::slug($request->category_name, '-');

        $category->update();

        return response()->json([
            'category_update' => "Category Updated Successfully"
        ]);
    }

    //   category delete method
    public function destroy($id)
    {
        Category::find($id)->delete();

        return response()->json([
            'category_delete' => "Category Deleted Successfully"
        ]);
    }
}
