<?php

namespace App\Http\Controllers\backend;
use Illuminate\Http\Request;
use App\Models\backend\Category;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
                    $actionBtn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-primary btn-sm edit_modal" data-toggle="modal"
                    data-target="#update_category_modal">Edit</a>
                                   <a href="#" class="btn btn-danger  btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
    }

    // store method for category insert
    public function store(Request $request)
    {
        // dd('sdf');
        $validate = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);
        
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();
        return response()->json(['add_new_category' => 'Successfully inserted']);  
      }
}
