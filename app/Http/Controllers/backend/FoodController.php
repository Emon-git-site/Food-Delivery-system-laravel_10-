<?php

namespace App\Http\Controllers\backend;

use App\Models\backend\Food;
use Illuminate\Http\Request;
use App\Models\backend\Category;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class FoodController extends Controller
{
        // Food list  show
        public function index(Request $request)
        {
            if ($request->ajax()) {
                $food = Food::latest()->get();
                return DataTables::of($food)
                    ->addIndexColumn()
                    ->editColumn('category_name', function($row){
                        return $row->category->category_name;
                    })
                    ->editColumn('subcategory_name', function($row){
                        return $row->subcategory->subcategory_name;
                    })
                    ->addColumn('action', function ($row) {
                        $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-sm edit_modal_btn" data-toggle="modal" data-target="#update_food_modal">Edit</a>
                                    <a href="' . route('admin.food.delete', [$row->id]) . '" class="btn btn-danger btn-sm" id="food_delete">Delete</a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action', 'category_name', 'subcategory_name'])
                    ->make(true);
            }
    
            $category = Category::all();
            return view('backend.food.index', compact('category'));
        }
}
