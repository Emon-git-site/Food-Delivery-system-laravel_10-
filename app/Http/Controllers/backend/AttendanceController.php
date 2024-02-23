<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Employee;
use Yajra\DataTables\DataTables;
use App\Models\backend\Attendance;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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
        $validateData = Validator::make($request->all(), [
            'clock_in' => ['nullable', 'regex:/^(2[0-3]|[01]?[0-9]):[0-5][0-9]$/'],
            'clock_out' => ['nullable', 'regex:/^(2[0-3]|[01]?[0-9]):[0-5][0-9]$/'],
            'clock_in_note' => 'nullable|string|max:255',
            'clock_out_note' => 'nullable|string|max:255',
        ]);

        if ($validateData->fails()) {
            return response()->json([
                'errors' => $validateData->errors()
            ]);
        }

        if ($request->user_ids == null) {
            return response()->json(['errorMsg' => 'Select Employee First for Attendance. ']);
        }
        foreach ($request->user_ids as $key => $user_id) {
            $updateAttendance = Attendance::where('date', now()->format('d-m-Y'))
                ->where('employee_id', $user_id)->first();
            if ($updateAttendance) {
                $updateAttendance->clock_out = $request->clock_outs[$key];
                if ($request->clock_outs[$key]) {
                    $updateAttendance->status = "Present";
                }
                $updateAttendance->clock_in_note = $request->clock_in_notes[$key];
                $updateAttendance->clock_out_note = $request->clock_out_notes[$key];
                $updateAttendance->save();
            } else {
                $data = new Attendance();
                $data->employee_id = $user_id;
                $data->date = date('d-m-Y');
                $data->clock_in = $request->clock_ins[$key];
                $data->clock_out = $request->clock_outs[$key];
                if ($request->clock_outs[$key]) {
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
            $filter = DB::table('attendances')
                ->leftJoin('employees', 'attendances.employee_id', 'employees.id');
            if ($request->employee_id) {
                $filter->where('attendances.employee_id', $request->employee_id);
            }
            if ($request->month) {
                $filter->where('attendances.month', $request->month);
            }
            if ($request->date) {
                $request_date = date('d-m-Y', strtotime($request->date));
                $filter->where('attendances.date', $request_date);
            }
            $attendance = $filter->select(
                'attendances.*',
                'employees.id as emp_id',
                'employees.name',
                'employees.employee_id'
            )->latest()->get();
            return Datatables::of($attendance)
                ->addIndexColumn()
                ->editColumn('name', function ($row) {
                    return $row->name . '-' . $row->employee_id;
                })
                ->editColumn('status', function ($row) {
                    if ($row->status == 'Present') {
                        return '<span class="badge badge-success">Present</span>';
                    } else {
                        return '<span class="badge badge-danger">Missing</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                            <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-sm edit_modal_btn" data-toggle="modal"
                               data-target="#update_attendance_modal"> <i class="fas fa-edit"></i></a>
                             <a href="' . route('admin.hrm.attendance.allAttendance.delete', [$row->id]) . '" class="btn btn-danger btn-sm" 
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
        $validateData = Validator::make($request->all(), [
            'clock_in' => ['nullable', 'regex:/^(2[0-3]|[01]?[0-9]):[0-5][0-9]$/'],
            'clock_out' => ['nullable', 'regex:/^(2[0-3]|[01]?[0-9]):[0-5][0-9]$/'],
            'clock_in_note' => 'nullable|string|max:255',
            'clock_out_note' => 'nullable|string|max:255',
        ]);

        if ($validateData->fails()) {
            return response()->json([
                'errors' => $validateData->errors()
            ]);
        }
        $request_date = date('d-m-Y', strtotime($request->date));
        $check = Attendance::where('employee_id', $request->employee_id)->where('date', $request_date)->first();
        if ($check) {
            return response()->json(['errorMsg' => 'Already Attendance Exist with This Date!.']);
        } else {
            $attendance = Attendance::make($request->except('status', 'month', 'year', 'date'));
            $attendance->date = $request_date;
            $attendance->status = "Present";
            $attendance->month = date('F');
            $attendance->year = date('Y');
            $attendance->save();

            return response()->json('Attendance Insert Successfully.');
        }
    }

    // edit attendance
    public function edit(Attendance $attendance)
    {
        $employees = Employee::all();
        return view('backend.hrm.attendance.partial.edit_attendance', compact('employees', 'attendance'));
    }

    // update attendance
    public function update(Request $request, Attendance $attendance)
    {
        $validateData = Validator::make($request->all(), [
            'clock_in' => ['nullable', 'regex:/^(2[0-3]|[01]?[0-9]):[0-5][0-9]$/'],
            'clock_out' => ['nullable', 'regex:/^(2[0-3]|[01]?[0-9]):[0-5][0-9]$/'],
            'clock_in_note' => 'nullable|string|max:255',
            'clock_out_note' => 'nullable|string|max:255',
        ]);

        if ($validateData->fails()) {
            return response()->json([
                'errors' => $validateData->errors()
            ]);
        }
        $attendance_id = $request->attendance_id;
        $attendance = Attendance::find($attendance_id);
        $attendance->fill($request->except('status', 'month', 'year'));
        $attendance->status = "Present";
        $attendance->month = date('F');
        $attendance->year = date('Y');
        $attendance->save();

        return response()->json('Attendance update Successfully.');
    }

    // attendance delete
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return response()->json([
            'attendance_delete' => 'Attendance  Deleted Successfully',
        ]);
    }


    // attendance adjustment
    public function adjustment()
    {
        $employees = Employee::all();
        return view('backend.hrm.attendance.attendance_adjustment_form', compact('employees'));
    }

    // adjustment form page
    public function adjustmentForm(Request $request)
    {
        $attendance = DB::table('attendances')->where('month', $request->month)->where('year', $request->year)
                      ->where('employee_id', $request->employee_id)->orderBy('date', 'ASC')->get();
        $user = Employee::where('id', $request->employee_id)->first();
        $employees = Employee::all();   
        return view('backend.hrm.attendance.attendance_adjustment', compact('attendance', 'user', 'employees'));
    }

    // adjustment clock in change
    public function adjustmentClockInChange($id, $date, $clock_in)
    {
        Attendance::where('employee_id', $id)->where('date', $date)
                    ->update(['clock_in' => $clock_in]);
        return response()->json('Clock In Time Successfully Updated');
    }

    // adjustment clock in change
    public function adjustmentClockOutChange($id, $date, $clock_out)
    {
        Attendance::where('employee_id', $id)->where('date', $date)
                    ->update(['clock_out' => $clock_out]);
        return response()->json('Clock Out Time Successfully Updated');
    }
}
