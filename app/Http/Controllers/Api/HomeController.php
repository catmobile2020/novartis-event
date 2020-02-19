<?php

namespace App\Http\Controllers\Api;

use App\Day;
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
     *      tags={"Agenda"},
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
        $rows = Day::with('sessions')->orderBy('date')->paginate(10);
        return AgendaResource::collection($rows);
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
