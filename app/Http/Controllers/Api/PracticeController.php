<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\PracticeOptionRate;
use App\Http\Requests\Api\UserPracticeRequest;
use App\Http\Resources\PracticeResource;
use App\Practice;
use App\Http\Controllers\Controller;
use App\PracticeOptions;

class PracticeController extends Controller
{
    /**
     *
     * @SWG\Get(
     *      tags={"practices"},
     *      path="/practices",
     *      summary="get all practices",
     *      security={
     *          {"jwt": {}}
     *      },
     *      @SWG\Response(response=200, description="object"),
     * )
     */
    public function index()
    {
        $rows = Practice::active()->get();
        return PracticeResource::collection($rows);
    }

    /**
     *
     * @SWG\Get(
     *      tags={"practices"},
     *      path="/practices/{practice}",
     *      summary="get single practice",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="practice",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param Practice $practice
     * @return PracticeResource
     */
    public function show(Practice $practice)
    {
        return PracticeResource::make($practice);
    }

    /**
     *
     * @SWG\post(
     *      tags={"practices"},
     *      path="/practices",
     *      summary="submit your practice",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="practice_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Parameter(
     *         name="practice_option_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param UserPracticeRequest $request
     * @return void
     */
    public function store(UserPracticeRequest $request)
    {
        $user = auth()->user();
        if ($user->practices()->where('practice_id',$request->practice_id)->first())
        {
            return $this->responseJson('You Already Submit this Vot Before.',400);
        }
        $ans = $user->practices()->create([
            'practice_option_id'=>$request->practice_option_id,
            'practice_id'=>$request->practice_id,
        ]);
        if ($ans)
        {
            return $this->responseJson('Send Successfully',200);
        }
        return $this->responseJson('Error Happen, Try Again!',400);
    }

    /**
     *
     * @SWG\post(
     *      tags={"practices"},
     *      path="/practices/options/rating",
     *      summary="submit your practice option rate",
     *      security={
     *          {"jwt": {}}
     *      },
     *      @SWG\Parameter(
     *         name="practice_option_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="rate",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param PracticeOptionRate $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function optionRates(PracticeOptionRate $request)
    {
        $practice_option = PracticeOptions::find($request->practice_option_id);
        $practice = $practice_option->practice;
        if ($practice->has_rate == 0)
        {
            return $this->responseJson("You Can't Add Rate To This Question!",400);
        }
        $user = auth()->user();
        if ($user->practiceOptions()->where('practice_options_id',$request->practice_option_id)->first())
        {
            return $this->responseJson('You Already Submit this Vot Before.',400);
        }
        $rate = $user->practiceOptions()->create([
            'practice_options_id'=>$request->practice_option_id,
            'rate'=>$request->rate,
        ]);
        if ($rate)
        {
            return $this->responseJson('Send Successfully',200);
        }
        return $this->responseJson('Error Happen, Try Again!',400);
    }
}
