<?php

namespace App\Http\Controllers\backend;

use Illuminate\Support\Str;
use App\Models\backend\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\backend\Blogcategory;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;

class blogController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    // blogcategory list  show
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Blog::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('category_name', function ($row) {
                    return $row->blogcategory->category_name;
                })

                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-sm edit_modal_btn" data-toggle="modal" data-target="#update_blog_modal">Edit</a>
                            <a href="' . route('admin.blog.delete', [$row->id]) . '" class="btn btn-danger btn-sm" id="blog_delete">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'category_name'])
                ->make(true);
        }

        $blogcategory = Blogcategory::all();
        return view('backend.blog.index', compact('blogcategory'));
    }

    // store method to insert data
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'blogcategory_id' => 'required|numeric',
            'blog_title' => 'required|string|max:255',
            'blog_description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:9048'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]); 
        }

        $imageFile = $request->file('image');
        $save_url = $this->savePostImage($imageFile);

        Blog::insert([
            'category_id' => $request->blogcategory_id,
            'title' => $request->blog_title,
            'title_slug' => Str::slug($request->blog_title, '-'),
            'user_id' => Auth::guard('admin')->user()->id,
            'description' => $request->blog_description,
            'created_date' => date('d-m-Y'),
            'created_month' => date('F'),
            'image' => $save_url
        ]);

        $notification = [
            'status' => 200,
            'new_blog_inserted' => 'New Blog Successfully'
        ];
        return response()->json($notification);
    }

    private function savePostImage($imageFile)
    {
        $manager = new ImageManager(new Driver());
        $name_gen = hexdec(uniqid()) . '.' . $imageFile->getClientOriginalExtension();
        $img = $manager->read($imageFile);
        $img = $img->resize(1200, 630);
        $img->toJpeg(80)->save(base_path('public/image/blog/' . $name_gen));
        return 'image/blog/' . $name_gen;
    }

    // edit method
    public function edit($id)
    {
        $blog = Blog::find($id);
        return response()->json($blog);
    }

    //   update method for update subcategory
    public function update(Request $request, $id)
    {
        //dd($request->blog_description_update);
        if ($request->image) {
            $blog = Blog::find($id);
            $blog->category_id = $request->blogcategory_id;
            $blog->title = $request->blog_title_update;
            $blog->title_slug = Str::slug($request->blog_title_update, '-');
            $blog->description = $request->blog_description_update;

            $imageFile = $request->file('image');
            $save_url = $this->savePostImage($imageFile);
            unlink($blog->image);
            $blog->image = $save_url;
            $blog->update();

            $notification = [
                'status' => 200,
                'blog_updated' => ' Blog Updated Successfully'
            ];
            return response()->json($notification);
        } else {
            $blog = Blog::find($id);
            $blog->category_id = $request->blogcategory_id;
            $blog->title = $request->blog_title_update;
            $blog->title_slug = Str::slug($request->blog_title_update, '-');
             $blog->description = $request->blog_description_update;
            $blog->update();

            $notification = [
                'status' => 200,
                'blog_updated' => 'Blog Updated Successfully'
            ];
            return response()->json($notification);
        }
    }

            //   blog delete method
            public function destroy($id)
            {
                $blog = Blog::find($id);
                unlink($blog->image);
                $blog->delete();
        
                return response()->json([
                    'blog_delete' => "SubCategory Deleted Successfully"
                ]);
            }
}
