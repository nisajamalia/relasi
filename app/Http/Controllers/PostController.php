<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request){
        $data = $request->all();
        $post = new Post;
        $post->title = $data['title'];
        $post->caption = $data['caption'];
        $post->url_image = $data['url_image'];
        $post->save();
        $status = "Success create data post";
        return response()->json(compact('status', 'post'), 200);

    }

    public function showPost(Post $post){
        $post->comment;
        $status = "succes get data post";
    
        return response()->
        json(compact('status','post'), 200);
    }

    // public function getAllDataPost() {
    //     $post = Post->all();
    //     $status = "status get all data post";
    //     return response()->json(compact('status', 'post'), 200);
    // }


    public function updatePost(Request $request, Post $post){
        $data = $request->all();
        //jika title ada dan tidak kosong 
        if(isset($data['title'])&& !empty($data['title'])){
            $post->title = $data['title'];
        }
        //jika caption ada dan tidak kosong 
        if(isset($data['caption'])){
            $post->caption = $data['caption'];
        }
        //jika url_image ada dan tidak kosong 
        if(isset($data['url_image'])&& !empty($data['url_image'])){
            $post->url_image = $data['url_image'];
        }
        $post->save();
        // $post->comment;
        $status = "success update data post";
        return response()->json(compact('status','post'), 200);
    }
    public function deletePost(Post $post){
        // $comments = $post->body;
        // foreach($comments as $comment){
        //     Comment::find($comment->id)->delete();
        // }
        $post->delete();
        $status = "success delete data post";
        return response()->json(compact('status'),200);
    }
}
