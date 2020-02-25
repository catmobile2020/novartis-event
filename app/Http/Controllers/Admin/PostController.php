<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\PostsResource;
use App\Post;
use App\PostComments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $rows = Post::with('comments')->latest()->paginate(20);
        return view('admin.pages.post.index',compact('rows'));
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
