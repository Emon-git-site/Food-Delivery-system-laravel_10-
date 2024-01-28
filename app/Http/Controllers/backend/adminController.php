<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{

    public function adminlogin(Request $request)
    {
        $check = $request->all();
        if(Auth::guard('admin')->attempt(['email' => $check['email'], 'password' => 
                $check['password'] ])){
                    // dd(Auth::guard('admin')->check());
                    return redirect()->route('admin.dashboard')->with('admin_login_success', 'admin login Successfully');
                }else{
                    return back()->with('wrong_email_password', 'Invalid Email Or Password');
                }

    }

    public function adminregister(Request $request)
    {
        Admin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('admin.login_form')->with('registration_message', 'Admin Created Successfully');
    }

    public function dashboard()
    {
        // dd(Auth::guard('admin')->check());
        return view('backend.dashboard');
    }

    public function adminlogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login_form')->with('admin_logout_message', 'Admin Logout Successfully');
    }
}
