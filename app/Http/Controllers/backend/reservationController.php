<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
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
            $data = Reservation::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                   if($row->status == "Approved"){
                    return  '<span class="badge badge-success">Approved</span>';
                   }elseif($row->status == "Success"){
                    return  '<span class="badge badge-success">Success</span>';
                   }else{
                    return   '<span class="badge badge-danger">Pending</span>';
                   }
                })

                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-sm edit_modal_btn" data-toggle="modal" data-target="#update_blog_modal">Edit</a>
                            <a href="' . route('admin.blog.delete', [$row->id]) . '" class="btn btn-danger btn-sm" id="blog_delete">Delete</a>';
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
            $validator = Validator::make($request->all(), [
                   'r_time' => 'nullable|string',
                    'r_date' => 'nullable|date',
                    'people' => 'nullable|integer|min:1',
                    'phone' => 'nullable|string|max:255',
                    'name' => 'nullable|string|max:255',
                    'details' => 'nullable|string',
                    'status' => 'nullable|string|max:255',
                    'r_month' => 'nullable|string|max:255',
                    'r_year' => 'nullable|digits:4',
                ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'validation_failed' => 'Form validation failed',
                    'validation_code' => $validator->errors()->toArray()
                ]);
            }else{
                $check = Reservation::where('phone', $request->phone)
                                     ->orwhere('r_date', $request->r_date)->first();
                if($check){
                    return response()->json('This person already reserve this date');
                }else{
                    Reservation::insert([
                        'r_time' => $request->time,
                        'r_date' => $request->date,
                        'name' => $request->name,
                        'phone' => $request->phone,
                        'people' => $request->people,
                        'status' => "Approved",
                        'r_year' => date('d-m-Y'),
                        'r_month' => date('F'),
                    ]);

                    return response()->json(['add_reservation' => 'Successfully Reservation Insert']);
                }
            }
   
        }

}
