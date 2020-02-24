<?php

namespace App\Http\Controllers\Admin;

use App\Day;
use App\DaySession;
use App\Http\Requests\Admin\DaySessionRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DaySessionsController extends Controller
{
    public function index(Day $day)
    {
        $rows = $day->sessions()->with('rates')->orderBy('time_from')->paginate(20);
        return view('admin.pages.day.session.index',compact('day','rows'));
    }

    public function create(Day $day)
    {
        $session = new DaySession();
        $speakers = User::onlySpeakers()->get();
        return view('admin.pages.day.session.form',compact('day','session','speakers'));
    }

    public function store(Day $day,DaySessionRequest $request)
    {
        $inputs = $request->all();
        $session = $day->sessions()->create($inputs);
        if ($request->speaker_id and count($request->speaker_id))
        {
           foreach ($request->speaker_id as $speaker)
           {
               $session->speakers()->create(['user_id'=>$speaker]);
           }
        }
        return redirect()->back()->with('message','Done Successfully');
    }

    public function show(Day $day,DaySession $session)
    {

    }

    public function edit(Day $day,DaySession $session)
    {
        $speakers = User::onlySpeakers()->get();
        return view('admin.pages.day.session.form',compact('day','session','speakers'));
    }

    public function update(Day $day,DaySessionRequest $request,DaySession $session)
    {
        $inputs = $request->all();
        $session->update($inputs);
        if ($request->speaker_id and count($request->speaker_id))
        {
            $session->speakers()->delete();
            foreach ($request->speaker_id as $speaker)
            {
                $session->speakers()->create(['user_id'=>$speaker]);
            }
        }
        return redirect()->back()->with('message','Done Successfully');
    }

    public function destroy(Day $day,DaySession $session)
    {
        $session->delete();
        return redirect()->back()->with('message','Done Successfully');
    }

    public function rates(Day $day,DaySession $session)
    {
        $rows = $session->rates()->latest()->paginate(20);
        return view('admin.pages.day.session.rates',compact('day','session','rows'));
    }
}
