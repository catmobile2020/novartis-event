<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UploadImage;
use App\Http\Requests\Admin\PostRequest;
use App\Http\Resources\PostsResource;
use App\Notifications\SendStatusNotification;
use App\Post;
use App\PostComments;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;

class PostController extends Controller
{
    use UploadImage;

    public function index(Request $request)
    {
        $rows = Post::with('comments')->latest()->paginate(20);
        return view('admin.pages.post.index',compact('rows'));
    }

    public function create()
    {
        $post = new Post;
        return view('admin.pages.post.form',compact('post'));
    }


    public function store(Request $request)
    {
        if (!$request->content and !$request->photo)
        {
            return redirect()->back()->with('message','You Can not Create Empty Post!');
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
        return redirect()->back()->with('message','Done Successfully');
    }


    public function show($id)
    {

    }


    public function edit(Post $post)
    {
        return view('admin.pages.post.form',compact('post'));
    }


    public function update(Request $request, Post $post)
    {
        $inputs = $request->all();
        $post->update($inputs);
        if ($request->photo)
            $this->upload($request->photo,$post,null,true);
        return redirect()->back()->with('message','Done Successfully');
    }

    public function destroy(Post $post)
    {
        $post->trash();
        return redirect()->back()->with('message','Done Successfully');
    }

    public function comments(Post $post)
    {
        $rows = $post->comments()->latest()->paginate(20);
        return view('admin.pages.post.comment',compact('rows','post'));
    }

    public function destroyComment(PostComments $comment)
    {
        $comment->delete();
        return redirect()->back()->with('message','Done Successfully');
    }
}
