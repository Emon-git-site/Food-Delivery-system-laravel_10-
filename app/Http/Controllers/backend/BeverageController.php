<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Beverage;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;

class BeverageController extends Controller
{

    // beverage list  show
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $beverage = Beverage::latest()->get();
            return DataTables::of($beverage)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-sm edit_modal_btn" data-toggle="modal" data-target="#update_beverage_modal">Edit</a>
                                    <a href="' . route('admin.beverage.delete', [$row->id]) . '" class="btn btn-danger btn-sm" id="beverage_delete">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.beverage.index');
    }

    public function store(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'beverage_name' => 'string|required|unique:beverages,b_name|max:255', 
            'beverage_price' => 'required|string',
            'beverage_image' =>  'required|image|max:5048'
        ]);


        if ($validateData->fails()) {
            return response()->json([
                'errors' => $validateData->errors()
            ]);
        }
        $imageFile = $request->file('beverage_image');
        $save_url = $this->savePostImage($imageFile);

        Beverage::create([
            'b_name' =>  $request->beverage_name,
            'b_price' =>  $request->beverage_price,
            'b_image' => $save_url
        ]);
        return response()->json([
            'beverage_add' => "New Beverage Item Added Successfully"
        ]);
    }

    public function edit($id)
    {
        $beverage = Beverage::find($id);
        return view('backend.beverage.edit', compact('beverage'));
    }

    //   update method for update food
    public function update(Request $request)
    {
        if ($request->beverage_image) {

            $validateData = Validator::make($request->all(), [
                'beverage_name' => 'string|required|max:255',
                'beverage_price' => 'required|string',
                'beverage_image' =>  'required|image|max:5048'
            ]);


            if ($validateData->fails()) {
                return response()->json([
                    'errors' => $validateData->errors()
                ]);
            }
            $beverage = Beverage::find($request->beverage_id);
            $imageFile = $request->file('beverage_image');
            $save_url = $this->savePostImage($imageFile);
            unlink($beverage->b_image);

            $beverage->update([
                'b_name' =>  $request->beverage_name,
                'b_price' =>  $request->beverage_price,
                'b_image' => $save_url
            ]);

            return response()->json([
                'food_update' => "Food Item Updated Successfully"
            ]);
        } else {
            $validateData = Validator::make($request->all(), [
                'beverage_name' => 'string|required|max:255', 
                'beverage_price' => 'required|string',
            ]);


            if ($validateData->fails()) {
                return response()->json([
                    'errors' => $validateData->errors()
                ]);
            }

            $beverage = Beverage::find($request->beverage_id);
            $beverage->update([
                'b_name' =>  $request->beverage_name,
                'b_price' =>  $request->beverage_price
            ]);

            return response()->json([
                'beverage_update' => "Beverage Item Updated Successfully"
            ]);
        }
    }

    private function savePostImage($imageFile)
    {
        $manager = new ImageManager(new Driver());
        $name_gen = hexdec(uniqid()) . '.' . $imageFile->getClientOriginalExtension();
        $img = $manager->read($imageFile);
        $img = $img->resize(370, 246);
        $img->toJpeg(80)->save(base_path('public/image/beverage/' . $name_gen));
        return 'image/beverage/' . $name_gen;
    }

    //   Beverage item delete method
    public function destroy($id)
    {
        $beverage = Beverage::find($id);
        // dd($beverage);
        unlink($beverage->b_image);
        $beverage->delete();

        return response()->json([
            'beverage_delete' => "Beverage Item Deleted Successfully"
        ]);
    }
}
