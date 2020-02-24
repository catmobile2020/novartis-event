<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PracticeAnswerRequest;
use App\Practice;
use App\PracticeOptions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PracticeOptionController extends Controller
{
    public function index(Practice $practice)
    {
        $rows = $practice->options()->latest()->paginate(20);
        return view('admin.pages.practice.answer.index',compact('practice','rows'));
    }

    public function create(Practice $practice)
    {
        $answer = new PracticeOptions();
        return view('admin.pages.practice.answer.form',compact('practice','answer'));
    }

    public function store(Practice $practice,PracticeAnswerRequest $request)
    {
        $inputs = $request->all();
        $practice->options()->create($inputs);
        return redirect()->back()->with('message','Done Successfully');
    }

    public function show(Practice $practice,PracticeOptions $answer)
    {

    }

    public function edit(Practice $practice,PracticeOptions $answer)
    {
        return view('admin.pages.practice.answer.form',compact('practice','answer'));
    }

    public function update(Practice $practice,PracticeAnswerRequest $request,PracticeOptions $answer)
    {
        $inputs = $request->all();
        $answer->update($inputs);
        return redirect()->back()->with('message','Done Successfully');
    }

    public function destroy(Practice $practice,PracticeOptions $answer)
    {
        $answer->delete();
        return redirect()->back()->with('message','Done Successfully');
    }
}
