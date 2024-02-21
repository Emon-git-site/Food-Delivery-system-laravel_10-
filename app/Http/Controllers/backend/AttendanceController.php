<?php
namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\backend\Employee;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\backend\Attendance;

class AttendanceController extends Controller
{
    // single Attendance
    public function index()
    {
        $employees = Employee::all();
        return view('backend.hrm.attendance.single_attendance', compact('employees'));
    }
    // row create method
    public function createRow($user_id)
    {
        $attendance = DB::table('attendances')
                      ->leftJoin('employees', 'attendances.employee_id', 'employees.id')
                      ->where('attendances.date', now()->format('d-m-Y'))
                      ->where('attendances.employee_id', $user_id)
                      ->select(
                        'attendances.*',
                        'employees.id as emp_id',
                        'employees.name',
                        'employees.employee_id',
                      )
                      ->orderBy('attendances.id', 'desc')
                      ->first();
        $employee = Employee::where('id', $user_id)->first();
        return view('backend.hrm.attendance.partial.row_create', compact('attendance', 'employee'));
    }

    // person attendance store
    public function store(Request $request)
    {
        if($request->user_ids == null){
            return response()->json(['errorMsg' => 'Select Employee First for Attendance. ']);
        }
        foreach($request->user_ids as $key => $user_id){
            $updateAttendance = Attendance::where('date', now()->format('d-m-Y'))
                                ->where('employee_id', $user_id)->first();
            if($updateAttendance){
                $updateAttendance->clock_out = $request->clock_outs[$key];
                if($request->clock_outs[$key]){
                    $updateAttendance->status = "Present";
                }
                $updateAttendance->clock_in_note = $request->clock_in_notes[$key];
                $updateAttendance->clock_out_note = $request->clock_out_notes[$key];
                $updateAttendance->save();
            }else{
                $data = new Attendance();
                $data->employee_id = $user_id;
                $data->date = date('d-m-Y');
                $data->clock_in = $request->clock_ins[$key];
                $data->clock_out = $request->clock_outs[$key];
                if($request->clock_outs[$key]){
                    $data->status = "Present";
                }
                $data->clock_in_note = $request->clock_in_notes[$key];
                $data->clock_out_note = $request->clock_out_notes[$key];
                $data->month = date('F');
                $data->year = date('Y');
                $data->save();
            }
        }

        return response()->json('Successfully Attendance Taken !');
    }

    // all attendance
    public function AllAttendance(Request $request)
    {
        if ($request->ajax()) {
            $attendance = DB::table('attendances')
            ->leftJoin('employees', 'attendances.employee_id', 'employees.id')
            ->select(
              'attendances.*',
              'employees.id as emp_id',
              'employees.name',
              'employees.employee_id',
            )
            ->latest()->get();
            return Datatables::of($attendance)
                ->addIndexColumn()
                ->editColumn('name', function($row){
                    return $row->name.'-'.$row->employee_id;
                })
                ->editColumn('status', function($row){
                    if($row->status == 'Present'){
                        return '<span class="badge badge-success">Present</span>';
                    }else{
                        return '<span class="badge badge-danger">Missing</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                            <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-sm edit_modal_btn" data-toggle="modal"
                               data-target="#update_attendance_modal"> <i class="fas fa-edit"></i></a>
                             <a href="' . route('admin.hrm.employee.award.delete', [$row->id]) . '" class="btn btn-danger btn-sm" 
                                id="attendance_delete"><i class="fas fa-trash"></i></a>
                            ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'name', 'status'])
                ->make(true);
        }
        $employees = Employee::all();
        return view('backend.hrm.attendance.all_attendance', compact('employees'));
    }

    // missing attendance store method
    public function missingStore(Request $request)
    {
        $request_date =date('d-m-Y', strtotime($request->date)) ;
        $check = Attendance::where('employee_id', $request->employee_id)->where('date', $request_date)->first();
        if($check){
            return response()->json(['errorMsg' => 'Already Attendance Exist with This Date!.']);
        }else{
            return response()->json('successs');
        }
    }
}
