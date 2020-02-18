<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\QuestionResource;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    /**
     *
     * @SWG\Get(
     *      tags={"Questions"},
     *      path="/questions",
     *      summary="get all Questions paginated",
     *      security={
     *          {"jwt": {}}
     *      },
     *      @SWG\Response(response=200, description="object"),
     * )
     */
    public function index()
    {
        $rows = Question::active()->paginate(10);
        return QuestionResource::collection($rows);
    }

    /**
     *
     * @SWG\Get(
     *     tags={"Questions"},
     *      path="/questions/{question}",
     *      summary="get single question",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="question",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param Question $question
     * @return QuestionResource
     */
    public function show(Question $question)
    {
        return QuestionResource::make($question);
    }
}
