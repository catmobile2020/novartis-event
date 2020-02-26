<?php

namespace App\Http\Controllers\Api;

use App\Helpers\UploadImage;
use App\Http\Requests\Api\CommentRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostsResource;
use App\Notifications\SendStatusNotification;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;

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
     *      },@SWG\Parameter(
     *         name="per_page",
     *         in="query",
     *         type="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     */
    public function index(Request $request)
    {
        $rows = Post::with('comments')->latest()->paginate($request->per_page ?:10);
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

        $notifyData=[
            'title'=>'New Post',
            'body'=>$post->content,
            'type'=>'post',
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

    /**
     *
     * @SWG\Delete(
     *      tags={"posts"},
     *      path="/posts/{post}",
     *      summary="delete post",
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
     * @param CommentRequest $request
     * @return void
     */
    public function destroy(Post $post)
    {
        $post->trash();
        return $this->responseJson('Done Successfully',200);
    }

}
