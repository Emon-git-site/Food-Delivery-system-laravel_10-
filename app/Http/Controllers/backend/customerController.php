<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

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
}
