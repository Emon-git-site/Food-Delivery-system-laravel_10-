<?php

namespace App\Http\Controllers\backend;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\backend\Category;
use App\Models\backend\Subcategory;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class subcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    { {
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

    // store method to insert data
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subcategory_name' => 'required|max:255',
        ]);

        $imageFile = $request->file('image');
        $save_url = $this->savePostImage($imageFile);


        $subcategory = new Subcategory();
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->subcategory_slug = Str::slug($request->subcategory_name, '-');
        $subcategory->image = $save_url;
        $subcategory->save();

        $notification = ['subcategory_inserted' => 'New Subcategory Successfully'];
        return redirect()->back()->with($notification);
    }

    private function savePostImage( $imageFile)
    {
        $manager = new ImageManager(new Driver());
        $name_gen = hexdec(uniqid()) . '.' . $imageFile->getClientOriginalExtension();
        $img = $manager->read($imageFile);
        $img = $img->resize(370, 246);
        $img->toJpeg(80)->save(base_path('public/image/category/' . $name_gen));
        return 'post_image/' . $name_gen;
    }
}
