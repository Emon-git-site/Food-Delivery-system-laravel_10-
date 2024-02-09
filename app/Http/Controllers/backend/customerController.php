<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class customerController extends Controller
{
    // reservation list show
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::latest()->get();

            return DataTables::of($users)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return  '<span class="badge badge-info">Active</span>';
                    }
                    return   '<span class="badge badge-danger">Deactive</span>';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-sm edit_modal_btn" data-toggle="modal" data-target="#update_reservation_modal">Edit</a>
                                <a href="' . route('admin.reservation.delete', [$row->id]) . '" class="btn btn-danger btn-sm" id="reservation_delete">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('backend.customer.index');
    }

    // store method
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|string|email|max:255|unique:users,email',
            'customer_phone' => 'nullable|string|unique:users,phone', 
            'customer_password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]); 
        }

       $customer = new User;
       $customer->name = $request->customer_name;
       $customer->email = $request->customer_email;
       $customer->phone = $request->customer_phone;
       $customer->password = Hash::make($request->customer_password);
       $customer->save();
       return response()->json([
        'status' => 200,
        'customer_create' => "New Customer  Created Successfully"
    ]);
    }
}
