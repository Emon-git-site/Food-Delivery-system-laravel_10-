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
                    $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-sm edit_modal_btn" data-toggle="modal" data-target="#update_customer_modal">Edit</a>';
                    if($row->status == 1){
                        $actionBtn .=' <a href="' . route('admin.customer.deactive', [$row->id]) . '" class="btn btn-danger btn-sm" id="customer_deacitve">Deactive</a>';
                    }else{
                        $actionBtn .=' <a href="' . route('admin.customer.active', [$row->id]) . '" class="btn btn-info btn-sm" id="customer_active">Active</a>';        
                    }
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
        $validator = Validator::make($request->all(), [
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

    //  edit method for edit Customer
    public function edit($id)
    {
        $customer = User::find($id);
        return view('backend.customer.edit', compact('customer'));
    }

    // update method for customer
    public function update(Request $request)
    {
        $id = $request->customer_id;
        $customer = User::find($id);
        $customer->name = $request->customer_name;
        $customer->email = $request->customer_email;
        $customer->phone = $request->customer_phone;
        $customer->update();


        return response()->json([
            'status' => 200,
            'customer_update' => 'Customer information updated successfully',
        ]);
    }

    // customer deactive method
    public function deactive($id)
    {
        $customer = User::find($id);
        $customer->status = 0;
        $customer->save();

        return response()->json([
            'status' => 400,
            'customer_deactivate' => "Customer Deactivate Successfully"
        ]);
    }
    // customer active method
    public function active($id)
    {
        $customer = User::find($id);
        $customer->status = 1;
        $customer->save();

        return response()->json([
            'status' => 200,
            'customer_activate' => "Customer Activate Successfully"
        ]);
    }
}
