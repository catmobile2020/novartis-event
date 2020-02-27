<?php

namespace App\Http\Controllers\Api;

use App\AgendaRateQuestions;
use App\Event;
use App\Http\Requests\Api\UserAgendaRateQuestion;
use App\Http\Resources\AgendaRateQuestionResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgendaRateQuestionController extends Controller
{

    /**
     *
     * @SWG\Get(
     *      tags={"agenda"},
     *      path="/agenda-rating",
     *      summary="aganda rating questions",
     *      security={
     *          {"jwt": {}}
     *      },
     *      @SWG\Response(response=200, description="object"),
     * )
     */
    public function index()
    {
        $rows = AgendaRateQuestions::with('options')->get();
        return AgendaRateQuestionResource::collection($rows);
    }

    /**
     *
     * @SWG\Post(
     *      tags={"agenda"},
     *      path="/agenda-rating/{rate_question}",
     *      summary="submit your vot",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="rate_question",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="value",
     *         in="formData",
     *         type="integer",
     *      ),
     *     @SWG\Parameter(
     *         name="options_ids[]",
     *         in="formData",
     *         type="array",
     *         collectionFormat="multi",
     *         uniqueItems=true,
     *         @SWG\Items(
     *           type="integer",
     *         ),
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param AgendaRateQuestions $rate_question
     * @param UserAgendaRateQuestion $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function submitRating(AgendaRateQuestions $rate_question,UserAgendaRateQuestion $request)
    {
        $user = auth()->user();
        if ($user->agendaRates()->where('agenda_rate_questions_id',$rate_question->id)->first())
        {
            return $this->responseJson('You Already Submit this Vot Before.',400);
        }
        $event_id = null;
        if ($event = Event::where('active',1)->first())
        {
            $event_id = $event->id;
        }
//        dd($event_id);
        if ($rate_question->type == 1)
        {
            $vot = $user->agendaRates()->create([
                'agenda_rate_questions_id'=>$rate_question->id,
                'value'=>$request->value,
                'event_id'=>$event_id,
            ]);
        }else
        {
            $vot = false;
            foreach ($request->options_ids as $option)
            {
                $user->agendaRates()->create([
                    'agenda_rate_questions_id'=>$rate_question->id,
                    'agenda_rate_options_id'=>$option,
                    'event_id'=>$event_id,
                ]);
                $vot = true;
            }
        }
        if ($vot)
        {
            return $this->responseJson('Send Successfully',200);
        }
        return $this->responseJson('Error Happen, Try Again!',400);
    }

    /**
     *
     * @SWG\Post(
     *      tags={"agenda"},
     *      path="/agenda-rating-by-string/{rate_question}",
     *      summary="submit your vot",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="rate_question",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="value",
     *         in="formData",
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="ids_values",
     *         in="formData",
     *         type="string",
     *         format="string",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param AgendaRateQuestions $rate_question
     * @param UserAgendaRateQuestion $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function submitRatingByString(AgendaRateQuestions $rate_question,Request $request)
    {
//        return response()->json(['test'=>555,'ids_values'=>$request->ids_values],200);
        $user = auth()->user();
        if ($user->agendaRates()->where('agenda_rate_questions_id',$rate_question->id)->first())
        {
            return $this->responseJson('You Already Submit this Vot Before.',400);
        }
        $event_id = null;
        if ($event = Event::where('active',1)->first())
        {
            $event_id = $event->id;
        }
//        dd($event_id);
        if ($rate_question->type == 1)
        {
            $vot = $user->agendaRates()->create([
                'agenda_rate_questions_id'=>$rate_question->id,
                'value'=>$request->value,
                'event_id'=>$event_id,
            ]);
        }else
        {
            $vot = false;
            $options_ids = array_filter(explode(',',$request->ids_values));
            foreach ($options_ids as $option)
            {
                $user->agendaRates()->create([
                    'agenda_rate_questions_id'=>$rate_question->id,
                    'agenda_rate_options_id'=>$option,
                    'event_id'=>$event_id,
                ]);
                $vot = true;
            }
        }
        if ($vot)
        {
            return $this->responseJson('Send Successfully',200);
        }
        return $this->responseJson('Error Happen, Try Again!',400);
    }
}
