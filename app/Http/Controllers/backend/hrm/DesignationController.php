<?php

namespace App\Http\Controllers\backend\hrm;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\backend\hrm\Designation;
use Illuminate\Support\Facades\Validator;

class DesignationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $designation = Designation::latest()->get();
            return DataTables::of($designation)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-sm edit_modal_btn" data-toggle="modal" data-target="#update_designation_modal">Edit</a>
                    <a href="' . route('admin.hrm.employee.designation.delete', [$row->id]) . '" class="btn btn-danger btn-sm" id="designation_delete">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.hrm.employee.designation.index');
    }


    // store method
    public function store(Request $request, Designation $designation)
    {
        $validator = Validator::make($request->all(), [
            'designation_name' => 'required|unique:designations,designation_name|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }

        $designation->create($request->all());
        return response()->json([
            'status' => 201,
            'designation_create' => "Floor name  Created Successfully"
        ]);
    }

    //   edit method for edit designation
    public function edit(Designation $designation)
    {
        return view('backend.hrm.employee.designation.edit', compact('designation'));
    }

        //   update method for update category
        public function update(Request $request)
        {
            $id = $request->designation_id;
            $designation = Designation::find($id);
            $designation->designation_name = $request->designation_name;
    
            $designation->update();
    
            return response()->json([
                'designation_update' => "Designation Updated Successfully"
            ]);
        }

            // FLoor delete method
    public function destroy( Designation $designation)
    {
        $designation->delete();

        return response()->json([
            'designation_delete' => "Designation Deleted Successfully"
        ]);
    }
}
