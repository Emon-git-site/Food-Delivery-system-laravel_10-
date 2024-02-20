<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Award;

use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\backend\Employee;
use Illuminate\Support\Facades\Validator;

class AwardController extends Controller
{
        // Award list show method
        public function index(Request $request)
        {
            if ($request->ajax()) {
                $award = Award::get();
                return Datatables::of($award)
                    ->addIndexColumn()
                    ->editColumn('name', function($row){
                        return $row->employee->name.'-'.$row->employee->employee_id;
                    })
                    ->addColumn('action', function ($row) {
                        $actionBtn = '
                                <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-sm edit_modal_btn" data-toggle="modal"
                                   data-target="#update_award_modal"> <i class="fas fa-edit"></i></a>
                                 <a href="' . route('admin.hrm.employee.award.delete', [$row->id]) . '" class="btn btn-danger btn-sm" 
                                    id="award_delete"><i class="fas fa-trash"></i></a>
                                ';
                        return $actionBtn;
                    })
                    ->rawColumns(['action', 'name'])
                    ->make(true);
            }
            $employees = Employee::all();
            return view('backend.hrm.employee.award.index', compact('employees'));
        }
    
        public function store(Request $request)
        {
            $validateData = Validator::make($request->all(), [
                'employee_id' => 'nullable|integer',
                'award_name' => 'nullable|string|max:255',
                'award_date' => 'nullable|date',
                'award_month' => 'nullable|string|max:255',
                'award_year' => 'nullable|string|max:4', 
                'details' => 'nullable|string',
            ]);
    
            if($validateData->fails()) {
                return response()->json([
                    'errors' => $validateData->errors()
                ]);
            }
            Award::create($request->all());

            return response()->json([
                'award_create' =>"Award Added Successfully"
            ]);
        }
    
        public function edit(Award $award)
        {
            $employees = Employee::all();
            return view('backend.hrm.employee.award.edit', compact('award', 'employees'));
        }
    
        
        public function update(Request $request)
        {
            $validateData = Validator::make($request->all(), [
                'employee_id' => 'nullable|integer',
                'award_name' => 'nullable|string|max:255',
                'award_date' => 'nullable|date',
                'award_month' => 'nullable|string|max:255',
                'award_year' => 'nullable|string|max:4', 
                'details' => 'nullable|string',
            ]);
            if($validateData->fails()) {
                return response()->json([
                    'errors' => $validateData->errors()
                ]);
            }
            $award = Award::where('id', $request->award_id)->first()                                            ;
            $award->update($request->all());

            return response()->json([
                'award_update' =>"Award Updated Successfully"
            ]);
        }
    
    
        public function destroy(Award $award)
        {
            $award->delete();
            return response()->json([
                'award_delete' =>'Award Deleted Successfully',
            ]);
        }
}
