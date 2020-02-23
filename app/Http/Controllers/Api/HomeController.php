<?php

namespace App\Http\Controllers\Api;

use App\Day;
use App\DaySession;
use App\Http\Requests\Api\RateRequest;
use App\Http\Resources\AccountResource;
use App\Http\Resources\AgendaResource;
use App\Http\Resources\SettingResource;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     *
     * @SWG\Get(
     *      tags={"setting"},
     *      path="/setting",
     *      summary="get setting details",
     *      security={
     *          {"jwt": {}}
     *      },
     *      @SWG\Response(response=200, description="object"),
     * )
     */
    public function setting()
    {
        $row = Setting::first();
        return SettingResource::make($row);
    }

    /**
     *
     * @SWG\Get(
     *      tags={"agenda"},
     *      path="/agenda",
     *      summary="get Agenda details",
     *      security={
     *          {"jwt": {}}
     *      },
     *      @SWG\Response(response=200, description="object"),
     * )
     */
    public function agenda()
    {
        $rows = Day::with('sessions')->active()->orderBy('date')->paginate(10);
        return AgendaResource::collection($rows);
    }

    /**
     *
     * @SWG\Get(
     *      tags={"agenda"},
     *      path="/agenda/{day}",
     *      summary="get Agenda details",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="day",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param Day $day
     * @return AgendaResource
     */
    public function singleDay(Day $day)
    {
        $dataArray = [
            'day'=>AgendaResource::make($day),
            'num_of_days'=>Day::with('sessions')->active()->count(),
        ];
        return response()->json($dataArray , 200);
    }

    /**
     *
     * @SWG\post(
     *      tags={"agenda"},
     *      path="/sessions/{session}/rating",
     *      summary="submit your rate",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="session",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Parameter(
     *         name="rate",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Parameter(
     *         name="comment",
     *         in="formData",
     *         type="string",
     *         format="string",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param DaySession $session
     * @param RateRequest $request
     * @return void
     */
    public function submitRate(DaySession $session,RateRequest $request)
    {
        $user = auth()->user();
        if ($session->rates()->where('user_id',$user->id)->first())
        {
            return $this->responseJson('You Already Submit Your Rate Before.',400);
        }
        $rate = $session->rates()->create([
            'rate'=>$request->rate,
            'comment'=>$request->comment,
            'user_id'=>$user->id,
        ]);
        if ($rate)
        {
            return $this->responseJson('Send Successfully',200);
        }
        return $this->responseJson('Error Happen, Try Again!',400);
    }


    /**
     *
     * @SWG\Get(
     *      tags={"speakers"},
     *      path="/speakers",
     *      summary="get speakers paginated",
     *      security={
     *          {"jwt": {}}
     *      },
     *      @SWG\Response(response=200, description="object"),
     * )
     */
    public function speakers()
    {
        $rows = User::onlySpeakers()->active()->paginate(10);
        return AccountResource::collection($rows);
    }

    /**
     *
     * @SWG\Get(
     *     tags={"speakers"},
     *      path="/speakers/{speaker}",
     *      summary="get single question",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="speaker",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param User $speaker
     * @return AccountResource
     */
    public function singleSpeaker(User $speaker)
    {
        return AccountResource::make($speaker);
    }



}
