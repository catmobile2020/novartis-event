<?php

namespace App\Http\Controllers\Api;

use App\Helpers\UploadImage;
use App\Http\Requests\Api\CommentRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostsResource;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    use UploadImage;
    /**
     *
     * @SWG\Get(
     *      tags={"posts"},
     *      path="/posts",
     *      summary="get all posts paginated",
     *      security={
     *          {"jwt": {}}
     *      },
     *      @SWG\Response(response=200, description="object"),
     * )
     */
    public function index()
    {
        $rows = Post::with('comments')->paginate(10);
        return PostsResource::collection($rows);
    }

    /**
     *
     * @SWG\Get(
     *     tags={"posts"},
     *      path="/posts/{post}",
     *      summary="get single post",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param Post $post
     * @return PostResource
     */
    public function show(Post $post)
    {
        return PostResource::make($post);
    }

    /**
     *
     * @SWG\Post(
     *      tags={"posts"},
     *      path="/posts",
     *      summary="store post",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="content",
     *         in="formData",
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="photo",
     *         in="formData",
     *         type="file",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param Post $post
     * @param Request $request
     * @return void
     */
    public function store(Post $post,Request $request)
    {
        if (!$request->content and !$request->photo)
        {
            return $this->responseJson("You Can not Create Empty Post!",400);
        }
        $user = auth()->user();
        $post = $user->posts()->create($request->all());
        if ($request->photo)
            $this->upload($request->photo,$post);
        return $this->responseJson('Send Successfully',200);
    }

    /**
     *
     * @SWG\Post(
     *      tags={"posts"},
     *      path="/posts/{post}/make-comment",
     *      summary="store comment to post",
     *      security={
     *          {"jwt": {}}
     *      },@SWG\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         type="integer",
     *      ),@SWG\Parameter(
     *         name="content",
     *         in="formData",
     *         type="string",
     *         format="string",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param Post $post
     * @param CommentRequest $request
     * @return void
     */
    public function makeComment(Post $post,CommentRequest $request)
    {
        $user = auth()->user();
        $post->comments()->create([
            'content'=>$request->content,
            'user_id'=>$user->id,
        ]);
        return $this->responseJson('Send Successfully',200);
    }
}