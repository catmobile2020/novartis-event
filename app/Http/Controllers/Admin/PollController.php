<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PollRequest;
use App\Poll;
use App\Http\Controllers\Controller;

class PollController extends Controller
{
    public function index()
    {
        $rows = Poll::paginate(20);
        return view('admin.pages.poll.index',compact('rows'));
    }

    public function create()
    {
        $poll = new Poll;
        return view('admin.pages.poll.form',compact('poll'));
    }


    public function store(PollRequest $request)
    {
        $inputs = $request->all();
        $poll = Poll::create($inputs);
        return redirect()->back()->with('message','Done Successfully');
    }


    public function show($id)
    {

    }


    public function edit(Poll $poll)
    {
        return view('admin.pages.poll.form',compact('poll'));
    }


    public function update(PollRequest $request, Poll $poll)
    {
        $inputs = $request->all();
        $poll->update($inputs);
        return redirect()->back()->with('message','Done Successfully');
    }


    public function destroy(Poll $poll)
    {
        $poll->delete();
        return redirect()->route('admin.polls.index')->with('message','Done Successfully');
    }

    public function users(Poll $poll)
    {
        $rows = $poll->userPolls()->paginate(20);
        return view('admin.pages.poll.user',compact('rows','poll'));
    }
}
