<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\backend\Expensetype;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ExpensetypeController extends Controller
{
    // expense type list  show
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Expensetype::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-sm edit_modal_btn" data-toggle="modal" data-target="#update_expensetype_modal">Edit</a>
                                <a href="' . route('admin.expensetype.delete', [$row->id]) . '" class="btn btn-danger btn-sm" id="expensetype_delete">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.expense.type.index');
    }

    // store method
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'expense_type' => 'required|string|unique:expensetypes,type_name|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }
        Expensetype::create([
            'type_name' => $request->expense_type,
        ]);
        return response()->json([
            'expensetype_create' => "New Expensetype  Created Successfully"
        ]);
    }

        //  edit method for edit expensetype
        public function edit($id)
        {
            $expensetype = Expensetype::find($id);
            return view('backend.expense.type.edit', compact('expensetype'));
        }

    // update method for expense type
    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'expense_type' => 'required|string|unique:expensetypes,type_name|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        }
        $id = $request->expensetype_id;
        $expensetype = Expensetype::find($id);
        $expensetype->type_name = $request->expense_type;
        $expensetype->update();


        return response()->json([
            'status' => 200,
            'expensetype_update' => 'Expensetype information updated successfully',
        ]);
    }

           // expensetype delete method
           public function destroy($id)
           {
            Expensetype::find($id)->delete();
       
               return response()->json([
                   'expensetype_delete' => "Expensetype Deleted Successfully"
               ]);
           }
}
