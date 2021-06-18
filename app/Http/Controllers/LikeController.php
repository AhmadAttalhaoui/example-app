<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function like($postId){
      $posts = Post::findorfail($postId);

      if($posts->user_id == Auth::user()->id){
        abort(403,"you can't like your own post")
      }

      $like = Like::where('post_id', '=', $postId)->where('user_id','=', Auth::user()->id)-first();

      if($like !=null){
          abort(403,'Cannot like a post more than once');
        }

        $like = new Like;
        $like ->user_id = Auth::user()->id;
        $like ->post_id = $postId;
        $like ->save();

        return redirect()->route('index')->with('status','Post Liked');
      }
}
