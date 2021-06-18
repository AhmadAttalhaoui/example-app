<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use Auth;

class PostController extends Controller
{

  public function __construct(){
    $this->middleware('auth',['except' => ['index', 'show']]);
  }



  public function show($id){
    $post = Post::findorfail($id);
    return view('post.show', compact('post'));
  }

  public function create(){
    return view('post.create');
  }

  public function store(Request $request){
    $validated = $request ->validate([
      'title'=>'required|min:3',
      'content'=> 'required|min:20'
    ]);

      $posts = new Post;
      $posts  ->title = $validated['title'];
      $posts  ->message = $validated['content'];
      $posts  ->user_id = Auth::user()->id;
      $posts  ->save();

      return redirect()->route('index')->with('status', 'Post added');
  }



    public function index(){

      $posts = Post::latest()->get();
      return view('post.index',compact('posts'));
      printf($posts);
    }


    public function edit($id){
      $posts = Post::findorfail($id);
      if($posts ->user_id !=Auth::user()->id){
        abort(403);
      }
      return view('post.edit',compact('posts'));
    }


    public function update($id, Request $request){
      $posts = Post::findorfail($id);

      if($posts->user_id !=Auth::user()->id){
        abort(403);
      }
      $validated = $request ->validate([
        'title'=>'required|min:3',
        'content'=> 'required|min:20'
      ]);

        $posts = new Post;
        $posts  ->title = $validated['title'];
        $posts  ->message = $validated['content'];
        $posts  ->user_id = Auth::user()->id;
        $posts  ->save();

        return redirect()->route('index')->with('status', 'Post edited');
    }
}
