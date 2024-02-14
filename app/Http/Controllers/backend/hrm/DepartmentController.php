<?php

namespace App\Http\Controllers\backend\hrm;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\backend\hrm\Department;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $department = Department::latest()->get();
            return DataTables::of($department)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-sm edit_modal_btn" data-toggle="modal" data-target="#update_department_modal">Edit</a>
                    <a href="' . route('admin.hrm.employee.department.delete', [$row->id]) . '" class="btn btn-danger btn-sm" id="department_delete">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.hrm.employee.department.index');
    }


    // store method
    public function store(Request $request, Department $department)
    {
        $validator = Validator::make($request->all(), [
            'department_name' => 'required|unique:departments,department_name|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }

        $department->create($request->all());
        return response()->json([
            'status' => 201,
            'Department_create' => "Department name  Created Successfully"
        ]);
    }

    //   edit method for edit Department
    public function edit(Department $department)
    {
        return view('backend.hrm.employee.department.edit', compact('department'));
    }

        //   update method for update department
        public function update(Request $request)
        {
            $id = $request->department_id;
            $department = Department::find($id);
            $department->department_name = $request->department_name;
    
            $department->update();
    
            return response()->json([
                'department_update' => "Department Updated Successfully"
            ]);
        }

            // Department delete method
    public function destroy( Department $department)
    {
        $department->delete();

        return response()->json([
            'department_delete' => "Department Deleted Successfully"
        ]);
    }
}
