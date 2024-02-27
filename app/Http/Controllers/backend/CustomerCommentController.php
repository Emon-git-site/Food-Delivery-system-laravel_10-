<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Intervention\Image\Colors\Rgb\Channels\Red;

class CustomerCommentController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $clientsay = DB::table('clientsays')
                            ->join('users', 'clientsays.user_id', '=', 'users.id')
                            ->orderBy('clientsays.created_at', 'desc')
                            ->select('clientsays.*', 'users.name as user_name') 
                            ->get();
        
            return DataTables::of($clientsay)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if ($row->status == 0) {
                        return '<span class="badge badge-danger">Pending</span>';
                    }
                    return '<span class="badge badge-success">Approved</span>';
                })
                ->editColumn('user_name', function($row){
                    return $row->user_name ? $row->user_name : 'No name available';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                        <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-sm edit_modal_btn" data-toggle="modal"
                           data-target="#update_customer-comment_modal">EDIT</a>
                         <a href="' . route('admin.customer-comment.delete', [$row->id]) . '" class="btn btn-danger btn-sm" 
                            id="customer-comment_delete">DELETE</a>
                        ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status', 'user_name'])
                ->make(true);
        }
        

        return view('backend.customer-comment.index');
    }

        //   edit method for edit customer-comment
        public function edit($id)
        {
            $customer_comment = DB::table('clientsays')
            ->join('users', 'clientsays.user_id', '=', 'users.id')
            ->where('clientsays.id', '=', $id)
            ->select('clientsays.*', 'users.name')
            ->first();
    
            return view('backend.customer-comment.edit', compact('customer_comment'));
        }
        // update method for update customer-comment
        public function update(Request $request)
        {
            $id = $request->customer_id;
            DB::table('clientsays')
            ->where('id', $id)
            ->update(['status' => $request->status]);
            return response()->json(['comment_update' => "Customer Comment Updated Successfully."]);
        }

        // delete method for delete cus
        public function destroy($id)
        {
            DB::table('clientsays')->where('id', $id)->delete();
            return response()->json(['comment_delete' => 'Customer Comment Deleted Successfully']);
        }
}
