<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\backend\Reservation;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class reservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    // reservation list show
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $filter = Reservation::query();
            if ($request->r_date) {
                $filter->where('r_date', $request->r_date);
            }
            if ($request->r_month) {
                $filter->where('r_month', $request->r_month);
            }
            if ($request->status) {
                $filter->where('status', $request->status);
            }
            $reservation = $filter->get();
            return DataTables::of($reservation)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if ($row->status == "Approved") {
                        return  '<span class="badge badge-info">Approved</span>';
                    } elseif ($row->status == "Success") {
                        return  '<span class="badge badge-success">Success</span>';
                    } elseif ($row->status == "Reject") {
                        return  '<span class="badge badge-danger">Reject</span>';
                    } else {
                        return   '<span class="badge badge-warning">Pending</span>';
                    }
                })

                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-sm edit_modal_btn" data-toggle="modal" data-target="#update_reservation_modal">Edit</a>
                            <a href="' . route('admin.reservation.delete', [$row->id]) . '" class="btn btn-danger btn-sm" id="reservation_delete">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('backend.reservation.index');
    }

    // store method for reservation insert
    public function store(Request $request)
    {
        $validator    = Validator::make($request->all(), [
            'r_time'  => 'nullable|string',
            'r_date'  => 'nullable|date',
            'people'  => 'nullable|integer|min:1',
            'phone'   => 'nullable|string|max:255',
            'name'    => 'nullable|string|max:255',
            'details' => 'nullable|string',
            'r_month' => 'nullable|string|max:255',
            'r_year'  => 'nullable|digits:4',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'            => 400,
                'validation_failed' => 'Form validation failed',
                'validation_code'   => $validator->errors()->toArray()
            ]);
        }
        $check = Reservation::where('phone', $request->phone)->orwhere('r_date', $request->r_date)->first();

        if ($check) {
            return response()->json([
                'already_available' => 'This person already reserve this date'
            ]);
        }
        Reservation::insert([
            'r_time' => $request->time,
            'r_date' => $request->date,
            'name' => $request->name,
            'phone' => $request->phone,
            'people' => $request->people,
            'details' => $request->details,
            'status' => "Pending",
            'r_year' => date('Y'),
            'r_month' => date('F'),
        ]);

        return response()->json(['add_reservation' => 'Successfully Reservation Insert']);
    }

    //  edit method for edit reservation
    public function edit($id)
    {
        $reservation = Reservation::find($id);
        return view('backend.reservation.edit', compact('reservation'));
    }

    // update method
    public function update(Request $request)
    {
        $id = $request->reservation_id;
        $reservation = Reservation::find($id);
        $reservation->update([
            'r_time' => $request->time,
            'r_date' => $request->date,
            'name' => $request->name,
            'phone' => $request->phone,
            'people' => $request->people,
            'details' => $request->details,
            'status' => $request->status,
        ]);


        return response()->json([
            'status' => 200,
            'reservation_update' => 'Reservation  updated successfully',
        ]);
    }

    // Reservation delete method
    public function destroy($id)
    {
        Reservation::find($id)->delete();

        return response()->json([
            'reservation_delete' => "Reservation Deleted Successfully"
        ]);
    }
}
