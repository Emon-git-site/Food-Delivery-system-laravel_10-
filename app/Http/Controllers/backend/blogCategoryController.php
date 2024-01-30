<?php

namespace App\Http\Controllers\backend;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\backend\Category;
use App\Http\Controllers\Controller;
use App\Models\backend\Blogcategory;
use Yajra\DataTables\Facades\DataTables;

class blogCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    // Blog Category list show method
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Blogcategory::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-sm edit_modal" data-toggle="modal"
                       data-target="#update_blogcategory_modal">EDIT</a>
                     <a href="' . route('admin.blogCategory.delete', [$row->id]) . '" class="btn btn-danger btn-sm" 
                        id="blogCategory_delete">DELETE</a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.blogCategory.index');
    }

    // store method for Blog category insert
    public function store(Request $request)
    {
        $validate = $request->validate([
            'blogcategory_name' => 'required|unique:blogcategories,category_name|max:255',
        ]);
        $blogCategory = new Blogcategory();
        $blogCategory->category_name = $request->blogcategory_name;
        $blogCategory->category_slug = Str::slug($request->blogcategory_name, '-');
        $blogCategory->save();
        return response()->json(['add_new_blogcategory' => 'New Blog Category Successfully inserted']);
    }

    //   edit method for edit category
    public function edit($id)
    {
        $data = Blogcategory::find($id);

        return response()->json($data);
    }

        //   update method for update Blog category
        public function update(Request $request, $id)
        {
            $blogCategory = Blogcategory::find($id);
            $blogCategory->category_name = $request->category_name;
            $blogCategory->category_slug = Str::slug($request->category_name, '-');
    
            $blogCategory->update();
    
            return response()->json([
                'blogcategory_update' => "Blog Category Updated Successfully"
            ]);
        }

     // Blog  category delete method
    public function destroy($id)
    {
        Blogcategory::find($id)->delete();

        return response()->json([
            'blogcategory_delete' => "Category Deleted Successfully"
        ]);
    }
}
