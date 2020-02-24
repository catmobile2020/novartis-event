<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PracticeRequest;
use App\Practice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PracticeController extends Controller
{
    public function index()
    {
        $rows = Practice::paginate(20);
        return view('admin.pages.practice.index',compact('rows'));
    }

    public function create()
    {
        $practice = new Practice;
        return view('admin.pages.practice.form',compact('practice'));
    }


    public function store(PracticeRequest $request)
    {
        $inputs = $request->all();
        $practice = Practice::create($inputs);
        return redirect()->back()->with('message','Done Successfully');
    }


    public function show($id)
    {

    }


    public function edit(Practice $practice)
    {
        return view('admin.pages.practice.form',compact('practice'));
    }


    public function update(PracticeRequest $request, Practice $practice)
    {
        $inputs = $request->all();
        $practice->update($inputs);
        return redirect()->back()->with('message','Done Successfully');
    }


    public function destroy(Practice $practice)
    {
        $practice->delete();
        return redirect()->back()->with('message','Done Successfully');
    }

    public function users(Practice $practice)
    {
        $rows = $practice->userPractices()->paginate(20);
        return view('admin.pages.practice.user',compact('rows','practice'));
    }
}
