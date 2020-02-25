<?php

namespace App\Http\Controllers\Api;

use App\Event;
use App\Http\Requests\Api\EventAttendanceRequest;
use App\Http\Resources\EventResource;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    /**
     *
     * @SWG\Get(
     *      tags={"events"},
     *      path="/events",
     *      summary="get all events paginated",
     *      security={
     *          {"jwt": {}}
     *      },
     *      @SWG\Response(response=200, description="object"),
     * )
     */
    public function index()
    {
        $rows = Event::orderBy('date')->paginate(10);
        return EventResource::collection($rows);
    }

    /**
     *
     * @SWG\post(
     *      tags={"events"},
     *      path="/events/{event}/attendance",
     *      summary="submit your attendance",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="event",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Parameter(
     *         name="attended",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         description="1=> yes 0=> no",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param Event $event
     * @param EventAttendanceRequest $request
     */
    public function attendance(Event $event,EventAttendanceRequest $request)
    {
        if (!$event->active)
        {
            return $this->responseJson('This Event Not Active!',400);
        }
        $user = auth()->user();
        if ($event->users()->where('user_id',$user->id)->first())
        {
            return $this->responseJson('You Already Submit this  Before.',400);
        }
        $vot = $event->users()->create([
            'attended'=>$request->attended,
            'user_id'=>$user->id,
        ]);
        if ($vot)
        {
            return $this->responseJson('Send Successfully',200);
        }
        return $this->responseJson('Error Happen, Try Again!',400);
    }
}
