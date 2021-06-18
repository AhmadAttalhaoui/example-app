<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Like;
use Auth;

class UserController extends Controller
{
public function __construct(){
    $this ->middleware('auth',['except' =>['index','make']]);
  }


  public function profile($name){
    $user = User::where('name','=',$name)->firstorfail();


    $posts = Post::where('user_id','=', $user -> id)->get();

    $likes = Like::where('user_id','=', $user -> id)->get();

    $ids = [];

  //   foreach ($likes as $like) {
  //     array_push($ids, $like->post_id);
  //   }
  //   $likedposts = Post::whereIn('id', $ids)->get();
  //
  //
    return view('user.profile',compact ('user','posts'));

  }

  public function admin($id){
    if (!Auth::user()->is_admin){
      abort(403, 'jij hebt de rechten niet' );
    }
    Model::where('attribut', $user->Attribut)->update(['is_admin' => 1]);

    $user = User::findorfail($id);

    return redirect()->route('index')->with('status', 'is admin geworden' );
  }


}
