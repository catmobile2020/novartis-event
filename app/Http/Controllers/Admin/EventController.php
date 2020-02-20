<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\Http\Requests\Admin\EventRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function index()
    {
        $rows = Event::with('users')->orderBy('date')->paginate(20);
        return view('admin.pages.event.index',compact('rows'));
    }

    public function create()
    {
        $event = new Event;
        return view('admin.pages.event.form',compact('event'));
    }


    public function store(EventRequest $request)
    {
        $inputs = $request->all();
        $event = Event::create($inputs);
        return redirect()->back()->with('message','Done Successfully');
    }


    public function show($id)
    {

    }


    public function edit(Event $event)
    {
        return view('admin.pages.event.form',compact('event'));
    }


    public function update(EventRequest $request, Event $event)
    {
        $inputs = $request->all();
        $event->update($inputs);
        return redirect()->back()->with('message','Done Successfully');
    }


    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.Events.index')->with('message','Done Successfully');
    }

    public function users(Event $event)
    {
        $rows = $event->users()->paginate(20);
        return view('admin.pages.event.user',compact('rows','event'));
    }
}
