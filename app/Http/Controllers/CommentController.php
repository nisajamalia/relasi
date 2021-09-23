<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    public function createComment(Request $request, Post $post ){
        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->body = $request->body;
        $comment->save();
        $post->comment;
        $status = "success create comment for post id : {$post->id}";
        return response()->json(compact('status', 'post'), 200);
    }

    public function updateComment(Request $request, Post $post, Comment $comment){
        if(isset($request->body)&& !empty($request->body)){
            $comment->body = $request->body;
        }
        $comment->save();
        $post->comment;
        $status = "success update comment for post id: {$post->id}";
        return response()->json(compact('status','post'), 200);
    }

    public function deleteComment(Post $post, Comment $comment){
        $comment->delete();
        $status = "success delete comment for post id: {$comment->title}";
        return response()->json(compact('status'), 200);
    }
}
