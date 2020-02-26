<?php

namespace App\Http\Controllers\Admin;

use App\AgendaRateQuestions;
use App\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgendaRateQuestionController extends Controller
{
    public function index()
    {
        $rows = AgendaRateQuestions::paginate(20);
        return view('admin.pages.agenda-rates.index',compact('rows'));
    }

    public function show(AgendaRateQuestions $question)
    {
        if (!$event = Event::where('active',1)->first())
        {
            return abort(404);
        }
        $rows = $question->userRates()->where('event_id',$event->id)->paginate(20);
        if ($question->type == 1)
        {
            return view('admin.pages.agenda-rates.user',compact('rows','question'));
        }
        return view('admin.pages.agenda-rates.chart',compact('rows','question'));
    }
}
