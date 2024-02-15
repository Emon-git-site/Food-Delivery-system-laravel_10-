<?php

namespace App\Http\Controllers\backend;

use Illuminate\Support\Str;
use App\Models\backend\Food;
use Illuminate\Http\Request;
use App\Models\backend\Category;
use Yajra\DataTables\DataTables;
use App\Models\backend\Subcategory;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;

class FoodController extends Controller
{
    // Food list  show
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $filter = Food::query();
            if ($request->subcategory_id) {
                $filter->where('subcategory_id', $request->subcategory_id);
            }
            if ($request->food_status) {
                $filter->where('status', $request->food_status);
            }
            $food = $filter->latest()->get();
            return DataTables::of($food)
                ->addIndexColumn()
                ->editColumn('category_name', function ($row) {
                    return $row->category->category_name;
                })
                ->editColumn('subcategory_name', function ($row) {
                    return $row->subcategory->subcategory_name;
                })
                ->editColumn('status', function ($row) {
                    if ($row->status == 0) {
                        return '<span class="badge badge-warning">Unpublished</span>';
                    } else {
                        return '<span class="badge badge-primary">Published</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-sm edit_modal_btn" data-toggle="modal" data-target="#update_food_modal">Edit</a>
                                    <a href="' . route('admin.food.delete', [$row->id]) . '" class="btn btn-danger btn-sm" id="food_delete">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'category_name', 'subcategory_name', 'status'])
                ->make(true);
        }

        $categories = Category::with('subcategories')->get();
        return view('backend.food.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'food_name' => 'string|required|max:255',
            'food_price' => 'required|numeric',
            'food_discournt_price' => 'numeric|required|lte:food_price',
            'food_image' =>  'required|image|max:5048',
            'food_description' => 'required|string'
        ]);

        if ($validateData->fails()) {
            return response()->json([
                'errors' => $validateData->errors()
            ]);
        }
        $imageFile = $request->file('food_image');
        $save_url = $this->savePostImage($imageFile);
        $category_id = Subcategory::where('id', $request->subcategory_id)->first();

        Food::create([
            'category_id' =>  $category_id->category_id,
            'subcategory_id' =>  $request->subcategory_id,
            'name' =>  $request->food_name,
            'slug' =>  Str::slug($request->food_name, '-'),
            'price' =>  $request->food_price,
            'discount_price' =>  $request->food_discournt_price,
            'image' =>  $save_url,
            'description' =>  $request->food_description,
            'user_id' =>  auth('admin')->id(),
            'status' => $request->food_status,
            'date' => date('Y-m-d'),
            'month' => date('F'),
            'year' => date('Y')
        ]);
        return response()->json([
            'food_add' => "New Food Item created Successfully"
        ]);
    }

    public function edit($id)
    {
        $food = Food::find($id);
        $categories = Category::with('subcategories')->get();
        return view('backend.food.edit', compact('categories', 'food'));
    }

    //   update method for update food
    public function update(Request $request)
    {
        if ($request->food_image) {

            $validateData = Validator::make($request->all(), [
                'food_name' => 'string|required|max:255',
                'food_price' => 'required|numeric',
                'food_discournt_price' => 'numeric|required|lte:food_price',
                'food_image' =>  'required|image|max:5048',
                'food_description' => 'required|string'
            ]);

            if ($validateData->fails()) {
                return response()->json([
                    'errors' => $validateData->errors()
                ]);
            }
            $food = Food::find($request->food_id);
            $imageFile = $request->file('food_image');
            $save_url = $this->savePostImage($imageFile);
            unlink($food->image);
            $category_id = Subcategory::where('id', $request->subcategory_id)->first();

            $food->update([
                'category_id' =>  $category_id->category_id,
                'subcategory_id' =>  $request->subcategory_id,
                'name' =>  $request->food_name,
                'slug' =>  Str::slug($request->food_name, '-'),
                'price' =>  $request->food_price,
                'discount_price' =>  $request->food_discournt_price,
                'image' =>  $save_url,
                'description' =>  $request->food_description,
                'user_id' =>  auth('admin')->id(),
                'status' => $request->food_status,
                'date' => date('Y-m-d'),
                'month' => date('F'),
                'year' => date('Y')
            ]);

            return response()->json([
                'food_update' => "Food Item Updated Successfully"
            ]);
        } else {
            $validateData = Validator::make($request->all(), [
                'food_name' => 'string|required|max:255',
                'food_price' => 'required|numeric',
                'food_discournt_price' => 'numeric|required|lte:food_price',
                'food_description' => 'required|string'
            ]);

            if ($validateData->fails()) {
                return response()->json([
                    'errors' => $validateData->errors()
                ]);
            }
            $food = Food::find($request->food_id);
            $category_id = Subcategory::where('id', $request->subcategory_id)->first();

            $food->update([
                'category_id' =>  $category_id->category_id,
                'subcategory_id' =>  $request->subcategory_id,
                'name' =>  $request->food_name,
                'slug' =>  Str::slug($request->food_name, '-'),
                'price' =>  $request->food_price,
                'discount_price' =>  $request->food_discournt_price,
                'description' =>  $request->food_description,
                'user_id' =>  auth('admin')->id(),
                'status' => $request->food_status,
                'date' => date('Y-m-d'),
                'month' => date('F'),
                'year' => date('Y')
            ]);

            return response()->json([
                'food_update' => "Food Item Updated Successfully"
            ]);
        }
    }

    private function savePostImage($imageFile)
    {
        $manager = new ImageManager(new Driver());
        $name_gen = hexdec(uniqid()) . '.' . $imageFile->getClientOriginalExtension();
        $img = $manager->read($imageFile);
        $img = $img->resize(370, 246);
        $img->toJpeg(80)->save(base_path('public/image/food/' . $name_gen));
        return 'image/food/' . $name_gen;
    }

    //   food item delete method
    public function destroy($id)
    {
        $food = Food::find($id);
        unlink($food->image);
        $food->delete();

        return response()->json([
            'food_delete' => "Foood Item Deleted Successfully"
        ]);
    }
}
