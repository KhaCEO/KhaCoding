<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function addPost(Request $request){

        $posts = new Posts();
        $posts->post_title = $request->post_title;
        $posts->post_content = $request->post_content;
        $posts->post_author = $request->post_author;

        $posts->save();
        return response()->json([
            'status' => true,
            'message' => 'Post has created is Success !'
        ]);
    }

    public function showPost($id)
    {
        $posts = Posts::find($id);
        return response()->json($posts);
    }
    public function updatePost(Request $request){

        $posts = Posts::findorfail($request->id);
        $posts->post_title = $request->post_title;
        $posts->post_content = $request->post_content;
        $posts->post_author = $request->post_author;

        $posts->update();
        return response()->json([
            'status' => true,
            'message' => 'Post has update is Success !'
        ]);
    }

    public function deletePost(Request $request){
        $posts = Posts::findorfail($request->id);
        $posts->delete();

        return response()->json([
            'status' => true,
            'message' => 'Post has deleted is Success !'
        ]);

    }

    public function Post(){
        $posts = Posts::all();
        return response()->json([
            'data' =>$posts
        ]);
    }
}
