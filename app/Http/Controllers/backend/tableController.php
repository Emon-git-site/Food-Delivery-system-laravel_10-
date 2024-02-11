<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Floor;
use App\Models\backend\Table;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class tableController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('admin');
    }

    // table list show method
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Table::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('floor_name', function($row){
                    return $row->floor->floor_name;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-sm edit_modal_btn" data-toggle="modal"
                        data-target="#update_table_modal">EDIT</a>
                        <a href="' . route('admin.table.delete', [$row->id]) . '" class="btn btn-danger btn-sm" 
                        id="table_delete">DELETE</a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['floor_name' ,'action'])
                ->make(true);
        }
        $floor = Floor::all();
        return view('backend.setup.table.index', compact('floor'));
    }

    // store method
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'floor_id' => 'required|exists:floors,id|numeric',
            'table_code' => 'nullable|string|max:255', 
            'table_sit' => 'required|string|max:255', 
        ]);
        if($validator->fails()){
                return response()->json([
                'status' => 401,
                'tableName_validation_failed' =>"Your given Table Information is not validate"
                ]);
        }else{
            Table::create($request->all());
            return response()->json([
                'status' => 201,
                'tableName_add' =>"Table Information Add Successfully"
                ]);
        }

    }

            
    //  edit method for edit table
    public function edit($id)
    {
        $table = Table::find($id);
        $floors = Floor::all();

        return view('backend.setup.table.edit', compact('table', 'floors'));
    }

    // update method
    public function update(Request $request)
    {
        $id = $request->table_id;
        $table = Table::find($id);
        $table->update([
            'floor_id' => $request->floor_id,
            'table_code' => $request->table_code,
            'table_sit' => $request->table_sit
        ]);

        
    return response()->json([
        'status' => 200,
        'table_update' => 'Table information updated successfully',
    ]);
    }

       // table delete method
       public function destroy($id)
       {
           Table::find($id)->delete();
   
           return response()->json([
               'table_delete' => "Table Deleted Successfully"
           ]);
       }
}


