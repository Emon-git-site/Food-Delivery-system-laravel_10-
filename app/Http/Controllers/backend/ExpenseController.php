<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Expense;
use Yajra\DataTables\DataTables;
use App\Models\backend\Expensetype;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    
    // blogcategory list  show
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $expense = Expense::latest()->get();
            return DataTables::of($expense)
                ->addIndexColumn()
                ->editColumn('type_name', function ($row) {
                    return $row->expensetype->type_name;
                })

                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-sm edit_modal_btn" data-toggle="modal" data-target="#update_expense_modal">Edit</a>
                            <a href="' . route('admin.expense.delete', [$row->id]) . '" class="btn btn-danger btn-sm" id="expense_delete">Delete</a>';
                    return $actionBtn;
                })
                
                ->rawColumns(['action', 'type_name'])
                ->make(true);
        }

        $expenseTypes = Expensetype::all();
        return view('backend.expense.index', compact('expenseTypes'));
    }

    
    // store method
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'nullable|string|max:255',
            'details' => 'nullable|string|max:1000',        
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]); 
        }
        Expense::create([
            'expensetype_id' => $request->expense_type_id,
            'user' => auth('admin')->user()->name,
            'amount' => $request->expense_amount,
            'details' => $request->expense_details,
            'month' => date('F'),
            'date' => date('Y-m-d'),
            'year' =>date('Y')
        ]);
        return response()->json([
            'expense_create' => "Expense  Created Successfully"
        ]);
    }


        //   edit method for edit Expense
        public function edit(Expense $expense)
        {    
            $expenseTypes = Expensetype::all();
            return view('backend.expense.edit', compact('expense', 'expenseTypes'));
        }
        
     // update method
    public function update(Request $request)
    {
        $id = $request->expense_id;
        $expense = Expense::find($id);
        $expense->update([
            'expensetype_id' => $request->expense_type_id,
            'amount' => $request->expense_amount,
            'details' => $request->expense_details,
        ]);

        
    return response()->json([
        'expense_update' => 'Expense information updated successfully',
    ]);
    }

        // expense delete method
        public function destroy($id)
        {
            Expense::find($id)->delete();
    
            return response()->json([
                'expense_delete' => "Expense Deleted Successfully"
            ]);
        }
}
