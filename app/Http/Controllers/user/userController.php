<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Flasher\Laravel\Facade\Flasher;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    public function comment()
    {
        $check = DB::table('clientsays')->where('user_id', auth()->id())->first();
        
        if($check){
            return view('customer.clientsay', compact('check')); 
        }
        return view('customer.clientsay'); 
    }

    // comment store method
    public function storeComment(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'rating' =>'required',
            'message' =>'required',
        ]);

        if ($validateData->fails()) {
            return response()->json([
                'errors' => $validateData->errors()
            ]);
        }

        $data =array(
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'message' => $request->message,
        );
        DB::table('clientsays')->insert($data);
        Flasher::addSuccess('Your review Add Successfully.');
        return redirect()->route('home');
    }
    // comment update method
    public function updateComment(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'rating' =>'required',
            'message' =>'required',
        ]);

        if ($validateData->fails()) {
            return response()->json([
                'errors' => $validateData->errors()
            ]);
        }

        $data =array(
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'message' => $request->message,
            'status' => 0,
        );
        DB::table('clientsays')->where('id', $request->id)->update($data);
        Flasher::addSuccess('Your review Updated Successfully.');
        return redirect()->route('home');
    }
}
