<?php

namespace App\Http\Controllers\Api;

use App\Events\VotingEvent;
use App\Http\Requests\Api\UserPollRequest;
use App\Http\Resources\PollResource;
use App\Http\Resources\PollsResource;
use App\Poll;
use App\Http\Controllers\Controller;

class VotingController extends Controller
{
    /**
     *
     * @SWG\Get(
     *      tags={"voting"},
     *      path="/polls",
     *      summary="get all polls paginated",
     *      security={
     *          {"jwt": {}}
     *      },
     *      @SWG\Response(response=200, description="object"),
     * )
     */
    public function index()
    {
        $rows = Poll::active()->paginate(10);
        return PollsResource::collection($rows);
    }

    /**
     *
     * @SWG\Get(
     *      tags={"voting"},
     *      path="/polls/{poll}",
     *      summary="get single poll",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="poll",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param Poll $poll
     * @return PollResource
     */
    public function show(Poll $poll)
    {
        return PollResource::make($poll);
    }

    /**
     *
     * @SWG\post(
     *      tags={"voting"},
     *      path="/polls",
     *      summary="submit your vot",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="poll_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Parameter(
     *         name="poll_options_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param UserPollRequest $request
     * @return void
     */
    public function store(UserPollRequest $request)
    {
        $user = auth()->user();
        if ($user->polls()->where('poll_id',$request->poll_id)->first())
        {
            return $this->responseJson('You Already Submit this Vot Before.',400);
        }
        $vot = $user->polls()->create([
            'poll_options_id'=>$request->poll_options_id,
            'poll_id'=>$request->poll_id,
        ]);
        if ($vot)
        {
            event(new  VotingEvent());
            return $this->responseJson('Send Successfully',200);
        }
        return $this->responseJson('Error Happen, Try Again!',400);
    }
}
