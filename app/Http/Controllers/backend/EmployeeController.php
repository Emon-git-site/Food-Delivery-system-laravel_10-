<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Employee;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use App\Models\backend\hrm\Department;
use App\Models\backend\hrm\Designation;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;

class EmployeeController extends Controller
{
        // Employee list  show
        public function index(Request $request)
        {
            if ($request->ajax()) {
                $employee = Employee::all();
                return DataTables::of($employee)
                    ->addIndexColumn()
                    ->editColumn('department_name', function ($row) {
                        return $row->department->department_name;
                    })
                    ->editColumn('designation_name', function ($row) {
                        return $row->designation->designation_name;
                    })
                    ->editColumn('status', function ($row) {
                        if ($row->status == 0) {
                            return '<span class="badge badge-danger">Deactive</span>';
                        } else {
                            return '<span class="badge badge-primary">Active</span>';
                        }
                    })
                    ->addColumn('action', function ($row) {
                        $editUrl = "javascript:void(0)";
                        $deleteUrl = route('admin.hrm.employee.employee.delete', [$row->id]);
                        $actionBtn = '<a href="' . $editUrl . '" data-id="' . $row->id . '" class="btn btn-primary btn-sm edit_modal_btn" data-toggle="modal" data-target="#update_employee_modal">Edit</a>
                                      <button data-url="' . $deleteUrl . '" class="btn btn-danger btn-sm delete-btn" id="employee_delete">Delete</button>'; 
                        return $actionBtn;
                    })
                    
                    ->rawColumns(['action', 'department_name', 'designation_name', 'status'])
                    ->make(true);
            }
    
            $departments = Department::all();
            $designations = Designation::all();
            return view('backend.hrm.employee.employee.index', compact('departments', 'designations'));
        }
    
        public function store(Request $request)
        {
            $validateData = Validator::make($request->all(), [
                'department_id' => 'required|exists:departments,id',
                'designation_id' => 'required|exists:designations,id',
                'name' => 'required|string|max:255',
                'phone' => 'nullable|string|max:255',
                'address' => 'nullable|string|max:255',
                'gender' => 'nullable|string|in:Male,Female,Other',
                'blood' => 'nullable|string|max:255',
                'nid' => 'nullable|string|max:255|unique:employees,nid',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'joining_date' => 'nullable|date',
                'salary' => 'nullable|numeric',
                'status' => 'nullable|integer|in:0,1',
            ]);
    
            if ($validateData->fails()) {
                return response()->json([
                    'errors' => $validateData->errors()
                ]);
            }
            $imageFile = $request->file('employee_image');
            $save_url = $this->savePostImage($imageFile);
    
            $employee = Employee::make($request->except('employee_image'));
            $employee->image = $save_url;
            $employee->save();
            return response()->json([
                'employee_add' => "New Employee  created Successfully"
            ]);
        }
    
        public function edit(Employee $employee)
        {
            $departments = Department::all();
            $designations = Designation::all();
            return view('backend.hrm.employee.employee.edit', compact('departments', 'designations', 'employee'));
        }
    
        //   update method for update employee
        public function update(Request $request)
        {
            $employee = Employee::where('employee_id', $request->employee_id)->first();
            
                $validateData = Validator::make($request->all(), [
                    'department_id' => 'required|exists:departments,id',
                    'designation_id' => 'required|exists:designations,id',
                    'name' => 'required|string|max:255',
                    'phone' => 'nullable|string|max:255',
                    'address' => 'nullable|string|max:255',
                    'gender' => 'nullable|string|in:Male,Female,Other',
                    'blood' => 'nullable|string|max:255',
                    'nid' => 'nullable|string|max:255|unique:employees,nid,' .$employee->id,
                    'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'joining_date' => 'nullable|date',
                    'salary' => 'nullable|numeric',
                    'status' => 'nullable|integer|in:0,1',
                ]);
    
                if ($validateData->fails()) {
                    return response()->json([
                        'errors' => $validateData->errors()
                    ]);
                }

                if ($request->hasFile('employee_image')){
                    $imageFile = $request->file('employee_image');
                    $save_url = $this->savePostImage($imageFile);
                    unlink($employee->image);
                    $employee->image = $save_url;
                    $employee->fill($request->except('employee_id'));               
                    $employee->save();
                }

                $employee->fill($request->except('employee_id', 'employee_image'));               
                $employee->save();

                return response()->json([
                    'employee_update' => "Employee Item Updated Successfully"
                ]);


        }
    
        private function savePostImage($imageFile)
        {
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $imageFile->getClientOriginalExtension();
            $img = $manager->read($imageFile);
            $img = $img->resize(370, 246);
            $img->toJpeg(80)->save(base_path('public/image/employee/' . $name_gen));
            return 'image/employee/' . $name_gen;
        }
    
        //   employee item delete method
        public function destroy(Employee $employee)
        {
            unlink($employee->image);
            $employee->delete();
    
            return response()->json([
                'employee_delete' => "Employee  Deleted Successfully"
            ]);
        }
}
