<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{

    public function index()
    {
        $setting = Setting::first();
        return view('admin.pages.setting',compact('setting'));
    }


    public function update(Request $request)
    {
        $setting = Setting::first();
        $setting->update($request->all());
        return redirect()->back()->with('message','Done Successfully');
    }
}
