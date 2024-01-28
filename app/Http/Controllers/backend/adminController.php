<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{

    public function dashboard()
    {
        return view('backend.dashboard');
    }

    public function login(Request $request)
    {
        $check = $request->all();
        if(Auth::guard('admin')->attempt(['email' => $check['email'], 'password' => 
                $check['password'] ])){

                    return redirect()->route('admin.dashboard')->with('admin_login_success', 'admin login Successfully');
                }else{
                    return back()->with('wrong_email_password', 'Invalid Email Or Password');
                }

    }
}
