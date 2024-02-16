<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\holiday;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\FuncCall;

class HolidayController extends Controller
{
    // Floor list show method
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $holiday = Holiday::get();
            return Datatables::of($holiday)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                            <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-sm edit_modal_btn" data-toggle="modal"
                               data-target="#update_holiday_modal">EDIT</a>
                             <a href="' . route('admin.hrm.holiday.delete', [$row->id]) . '" class="btn btn-danger btn-sm" 
                                id="holiday_delete">DELETE</a>
                            ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.hrm.holiday.index');
    }

    public function store(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'type' => 'required|string|max:255',
            'name' => 'required|string:max:255',
            'from' => 'date|required',
            'to' => 'date|required',
            'num_of_days' => 'numeric|required',
        ]);

        if($validateData->fails()) {
            return response()->json([
                'errors' => $validateData->errors()
            ]);
        }
        $holiday = Holiday::make($request->except('month', 'year'));
        $holiday->month = date('F');
        $holiday->year = date('Y');
        $holiday->save();
        return response()->json([
            'holiday_create' =>"Holiday Added Successfully"
        ]);
    }

    public function edit(Holiday $holiday)
    {
        return view('backend.hrm.holiday.edit', compact('holiday'));
    }

    
    public function update(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'type' => 'required|string|max:255',
            'name' => 'required|string:max:255',
            'from' => 'date|required',
            'to' => 'date|required',
            'num_of_days' => 'numeric|required',
        ]);

        if($validateData->fails()) {
            return response()->json([
                'errors' => $validateData->errors()
            ]);
        }
        $holiday = Holiday::where('id', $request->holiday_id)->first();
        $holiday->fill($request->except('month', 'year'));
        $holiday->month = date('F');
        $holiday->year = date('Y');
        $holiday->save();
        return response()->json([
            'holiday_update' =>"Holiday Updated Successfully"
        ]);
    }


    public function destroy(Holiday $holiday)
    {
        $holiday->delete();
        return response()->json([
            'holiday_delete' =>'Holi Day Deleted Successfully',
        ]);
    }
}
