<?php

namespace App\Http\Controllers\Admin;

use App\Day;
use App\Http\Requests\Admin\DayRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DayController extends Controller
{
    public function index()
    {
        $rows = Day::with('sessions')->orderBy('date')->paginate(20);
        return view('admin.pages.day.index',compact('rows'));
    }

    public function create()
    {
        $day = new Day;
        return view('admin.pages.day.form',compact('day'));
    }


    public function store(DayRequest $request)
    {
        $inputs = $request->all();
        $day = Day::create($inputs);
        return redirect()->back()->with('message','Done Successfully');
    }


    public function show($id)
    {

    }


    public function edit(Day $day)
    {
        return view('admin.pages.day.form',compact('day'));
    }


    public function update(DayRequest $request, Day $day)
    {
        $inputs = $request->all();
        $day->update($inputs);
        return redirect()->back()->with('message','Done Successfully');
    }


    public function destroy(Day $day)
    {
        $day->delete();
        return redirect()->back()->with('message','Done Successfully');
    }

    public function users(Day $day)
    {
        $rows = $day->users()->paginate(20);
        return view('admin.pages.day.user',compact('rows','day'));
    }
}
