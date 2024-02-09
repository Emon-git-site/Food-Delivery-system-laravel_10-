<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Floor;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class floorController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    // Floor list show method
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Floor::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                        <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-sm edit_modal_btn" data-toggle="modal"
                           data-target="#update_floor_modal">EDIT</a>
                         <a href="' . route('admin.floor.delete', [$row->id]) . '" class="btn btn-danger btn-sm" 
                            id="floor_delete">DELETE</a>
                        ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.setup.floor.index');
    }

    // store method
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'floor_name' => 'required|unique:floors,floor_name|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 401,
                'floorName_validation_failed' => "Your given Floor name is already Available"
            ]);
        }

        Floor::create($request->all());
        return response()->json([
            'status' => 201,
            'floorName_create' => "Floor name  Created Successfully"
        ]);
    }


    //   edit method for edit floor
    public function edit($id)
    {
        $floor = Floor::find($id);

        return view('backend.setup.floor.edit', compact('floor'));
    }

    //   update method for update category
    public function update(Request $request)
    {
        $id = $request->floor_id;
        $floor = Floor::find($id);
        $floor->floor_name = $request->floor_name_update;

        $floor->update();

        return response()->json([
            'floor_update' => "Floor Updated Successfully"
        ]);
    }

    // FLoor delete method
    public function destroy($id)
    {
        Floor::find($id)->delete();

        return response()->json([
            'floor_delete' => "Floor Deleted Successfully"
        ]);
    }
}
