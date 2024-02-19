<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\backend\Leavetype;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LeavetypeController extends Controller
{
        // Floor list show method
        public function index(Request $request)
        {
            if ($request->ajax()) {
                $leaveType = Leavetype::get();
                return Datatables::of($leaveType)
                    ->addIndexColumn()
                    ->editColumn('type_name', function ($row) {
                        if ($row->type_name == 'CL') {
                            return '<span class="badge badge-primary">Casual Leave</span>';
                        } elseif($row->type_name == 'SL') {
                            return '<span class="badge badge-secondary">Sick Leave</span>';
                        }elseif($row->type_name == 'EL'){
                            return '<span class="badge badge-info">Earned Leave</span>';
                        }
                    })
                    ->addColumn('action', function ($row) {
                        $actionBtn = '
                                <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-sm edit_modal_btn" data-toggle="modal"
                                   data-target="#update_leaveType_modal">EDIT</a>
                                 <a href="' . route('admin.hrm.leaveType.delete', [$row->id]) . '" class="btn btn-danger btn-sm" 
                                    id="leaveType_delete">DELETE</a>
                                ';
                        return $actionBtn;
                    })
                    ->rawColumns(['action', 'type_name'])
                    ->make(true);
            }
            return view('backend.hrm.leave.leavetype.index');
        }
    
        public function store(Request $request)
        {
            $validateData = Validator::make($request->all(), [
                'type_name' => 'required|string|in:CL,SL,EL', 
                'leave_day' => 'nullable|string', 
            ]);
    
            if($validateData->fails()) {
                return response()->json([
                    'errors' => $validateData->errors()
                ]);
            }
             Leavetype::create($request->all());
            return response()->json([
                'leaveType_create' =>"Leavetype Added Successfully"
            ]);
        }
    
        public function edit(Leavetype $leaveType)
        {

            return view('backend.hrm.leave.leavetype.edit', compact('leaveType'));
            
        }
    
        
        public function update(Request $request)
        {
            $validateData = Validator::make($request->all(), [
                'type_name' => 'required|string|in:CL,SL,EL', 
                'leave_day' => 'nullable|string', 
            ]);
    
            if($validateData->fails()) {
                return response()->json([
                    'errors' => $validateData->errors()
                ]);
            }
            $leaveType = Leavetype::where('id', $request->leaveType_id)->first();
            $leaveType->update($request->all());

            return response()->json([
                'leaveType_update' =>"Leavetype Updated Successfully"
            ]);
        }
    
    
        public function destroy(Leavetype $leaveType)
        {

            $leaveType->delete();
            return response()->json([
                'leaveType_delete' =>'HoliDay Deleted Successfully',
            ]);
        }
}
