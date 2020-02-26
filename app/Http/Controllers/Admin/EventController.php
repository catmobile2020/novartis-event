<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\Http\Requests\Admin\EventRequest;
use App\Notifications\SendStatusNotification;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;

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
        $old_status = $event->active;
        $inputs = $request->all();
        $event->update($inputs);
        if ($old_status == 0 and $request->active == 1)
        {
            $notifyData=[
                'title'=>'New Event',
                'body'=>$event->date,
                'type'=>'event',
            ];

            $beamsClient = new \Pusher\PushNotifications\PushNotifications(array(
                "instanceId" => "e3261a40-f1c1-4a9d-b568-4da52ee960ec",
                "secretKey" => "18DEC2C7A3EE24641D7C5AE81398FC5E8A0CCD9E1534379B23308C0457B702FC",
            ));

            $beamsClient->publishToInterests(
                array("debug-hello"),
                array(
                    "apns" => array("aps" => array(
                        "alert" => $notifyData
                    ))
                ));

            $beamsClientFcm = new \Pusher\PushNotifications\PushNotifications(array(
                "instanceId" => "452845e8-2506-4150-803d-b1bf738dbde0",
                "secretKey" => "0AB5B6E366B0289EF3F8473B7DC4401E85E4B6FF4BE8AEF9DDDDC37B8A0B2350",
            ));

            $beamsClientFcm->publishToInterests(
                array("debug-notification"),
                array(
                    "fcm" => array(
                        "notification" =>$notifyData
                    )
                ));

            Notification::send(User::whereIn('type',[2,3])->get(),new SendStatusNotification($notifyData));
        }
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
