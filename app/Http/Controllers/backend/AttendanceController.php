<?php
namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Employee;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\backend\Attendance;

class AttendanceController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('backend.hrm.attendance.single_attendance', compact('employees'));
    }
    // row create method
    public function createRow($user_id)
    {
        // dd($user_id);
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
        //  dd($attendance);
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
            $updateAttendance = Attendance::whereDate('date', date('d-m-Y'))
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
}
