<?php

namespace App\Http\Controllers\backend;

use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\backend\Leave;
use App\Http\Controllers\Controller;
use App\Models\backend\Employee;
use App\Models\backend\Leavetype;
use Illuminate\Support\Facades\Validator;

class LeaveController extends Controller
{
        // Leave list show method
        public function index(Request $request,)
        {
            if ($request->ajax()) {
                $leave = Leave::get();
                return Datatables::of($leave)
                    ->addIndexColumn()
                    ->editColumn('status', function ($row) {
                        if ($row->status == '0') {
                            return '<span class="badge badge-warning">Pending</span>';
                        } elseif($row->status == '1') {
                            return '<span class="badge badge-success">Approved</span>';
                        }elseif($row->status == '3'){
                            return '<span class="badge badge-danger">Declined</span>';
                        }
                    })
                    ->editColumn('employee_name', function ($row) {
                        return $row->employee->name;
                    })
                    ->editColumn('type_name', function ($row) {
                        if ($row->leavetype_name == 'CL') {
                            return '<span class="badge badge-primary">Casual Leave</span>';
                        } elseif($row->leavetype_name == 'SL') {
                            return '<span class="badge badge-secondary">Sick Leave</span>';
                        }elseif($row->leavetype_name == 'EL'){
                            return '<span class="badge badge-info">Earned Leave</span>';
                        }
                    })
                    ->addColumn('action', function ($row) {
                        $actionBtn = '
                                <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-sm edit_modal_btn" data-toggle="modal"
                                   data-target="#update_leave_modal">EDIT</a>
                                 <a href="' . route('admin.hrm.leave.delete', [$row->id]) . '" class="btn btn-danger btn-sm" 
                                    id="leave_delete">DELETE</a>
                                ';
                        return $actionBtn;
                    })
                    ->rawColumns(['action', 'status', 'type_name', 'employee_name'])
                    ->make(true);
                }

            $employees = Employee::all();
            $leaveTypes = Leavetype::all();
            return view('backend.hrm.leave.application.index', compact('employees', 'leaveTypes'));
        }
    
        public function store(Request $request)
        {
            $validateData = Validator::make($request->all(), [
                'employee_id' => 'nullable|integer',
                'leavetype_name' => 'nullable|string',
                'start_date' => 'nullable|date', 
                'end_date' => 'nullable|date|after_or_equal:start_date',
                'leave_day' => 'nullable|string|max:255',
                'month' => 'nullable|string|',
                'year' => 'nullable|digits:4',
                'status' => 'required|in:0,1,3',
            ]);
    
            if($validateData->fails()) {
                return response()->json([
                    'errors' => $validateData->errors()
                ]);
            }
            $leave = Leave::make($request->except('date', 'month', 'year'));
            $leave->date = date('Y-m-d');
            $leave->month = date('F');
            $leave->year = date('Y');
            $leave->save();
            return response()->json([
                'leaveApplication_add' =>"Leave Application Added Successfully"
            ]);
        }
    
        public function edit(Leave $leave)
        {
            $employees = Employee::all();
            $leaveTypes = Leavetype::all();
            return view('backend.hrm.leave.application.edit', compact('employees', 'leaveTypes', 'leave'));
        }
    
        
        public function update(Request $request)
        {
            $validateData = Validator::make($request->all(), [
                'employee_id' => 'nullable|integer',
                'leavetype_name' => 'nullable|string',
                'start_date' => 'nullable|date', 
                'end_date' => 'nullable|date|after_or_equal:start_date',
                'leave_day' => 'nullable|string|max:255',
                'month' => 'nullable|string|',
                'year' => 'nullable|digits:4',
                'status' => 'required|in:0,1,3',
            ]);
    
            if($validateData->fails()) {
                return response()->json([
                    'errors' => $validateData->errors()
                ]);
            }
            $leave = Leave::where('id', $request->leave_id)->first();
            $leave->fill($request->except('date', 'month', 'year'));
            $leave->date = date('Y-m-d');
            $leave->month = date('F');
            $leave->year = date('Y');
            $leave->save();
            return response()->json([
                'leave_update' =>"Leave Updated Successfully"
            ]);
        }
    
    
        public function destroy(Leave $leave)
        {
            $leave->delete();
            return response()->json([
                'leave_delete' =>'Holi Day Deleted Successfully',
            ]);
        }
}
