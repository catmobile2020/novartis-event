<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PollAnswerRequest;
use App\Poll;
use App\PollOptions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PollOptionController extends Controller
{
    public function index(Poll $poll)
    {
        $rows = $poll->options()->latest()->paginate(20);
        return view('admin.pages.poll.option.index',compact('poll','rows'));
    }

    public function create(Poll $poll)
    {
        $option = new PollOptions();
        return view('admin.pages.poll.option.form',compact('poll','option'));
    }

    public function store(Poll $poll,PollAnswerRequest $request)
    {
        $inputs = $request->all();
        $poll->options()->create($inputs);
        return redirect()->back()->with('message','Done Successfully');
    }

    public function show(Poll $poll,PollOptions $option)
    {

    }

    public function edit(Poll $poll,PollOptions $option)
    {
        return view('admin.pages.poll.option.form',compact('poll','option'));
    }

    public function update(Poll $poll,PollAnswerRequest $request,PollOptions $option)
    {
        $inputs = $request->all();
        $option->update($inputs);
        return redirect()->back()->with('message','Done Successfully');
    }

    public function destroy(Poll $poll,PollOptions $option)
    {
        $option->delete();
        return redirect()->back()->with('message','Done Successfully');
    }
}
