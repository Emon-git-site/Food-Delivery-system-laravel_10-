<?php

namespace App\Http\Controllers;

use App\Models\Website_setting;
use Illuminate\Http\Request;

class Website_settingController extends Controller
{
    public function index()
    {
        $website_setting = Website_setting::find(1);
        return view('backend.website_setting.index' , compact('website_setting'));
    }

    public function update(Request $request)
    {
        $website_setting = Website_setting::find(1);
        $website_setting->update($request->all());
        return response()->json(['setting_update' => 'Website setting updated Successfully']);;
    }
}
