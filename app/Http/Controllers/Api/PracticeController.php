<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserPracticeRequest;
use App\Http\Resources\PracticeResource;
use App\Practice;
use App\Http\Controllers\Controller;

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
}
