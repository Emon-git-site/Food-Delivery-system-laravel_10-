<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Subcategory;
use App\Http\Controllers\Controller;
use App\Models\backend\Category;
use Yajra\DataTables\Facades\DataTables;

class subcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        {
            if ($request->ajax()) {
                $data = Subcategory::latest()->get();
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
        $category = Category::all();
        return view('backend.subcategory.index', compact('category'));
    }
}
