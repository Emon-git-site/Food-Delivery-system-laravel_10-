<?php

namespace App\Http\Controllers\Front;

use App\Models\backend\Food;
use Illuminate\Http\Request;
use App\Models\backend\Category;
use App\Models\backend\Reservation;
use App\Models\backend\Subcategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class frontendController extends Controller
{

    // welcome page show
    public function index()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $tops = Food::where('top', 1)->latest()->limit(6)->get();
        return view('welcome', compact('categories', 'subcategories', 'tops'));
    }
        // store method for reservation insert
        public function reservationStore(Request $request)
        {
            $validator    = Validator::make($request->all(), [
                'r_time'  => 'nullable|string',
                'r_date'  => 'nullable|date',
                'people'  => 'nullable|integer|min:1',
                'phone'   => 'nullable|string|max:255',
                'name'    => 'nullable|string|max:255',
                'details' => 'nullable|string',
            ]);
    

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ]);
            }
            if(auth()->check()){

                $check = Reservation::where('phone', $request->phone)->orwhere('r_date', $request->r_date)->first();
        
                if ($check) {
                    return response()->json([
                        'already_available' => 'This person already reserve this date'
                    ]);
                }
                Reservation::insert([
                    'r_time' => $request->r_time,
                    'r_date' => $request->r_date,
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'people' => $request->people,
                    'details' => $request->details,
                    'user_id' => Auth::id(),
                    'status' => "Pending",
                    'r_year' => date('Y', strtotime($request->r_date)),
                    'r_month' => date('F', strtotime($request->r_date)),
                ]);
        
                return response()->json(['add_reservation' => 'Successfully Reservation Insert']);
            }else{
                return response()->json(['need_login' => 'You Need to Login your Account']);
            }
        }
}
