@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> {{$post->title}}</div>

                <div class="card-body">

                  {{$post->message}}
                  <br>
                  <br>
                      <small>gepoost door <a href="{{route('profile', $post->user->name)}}">{{$post->user->name}}</a> op {{$post->created_at->format('d/m/Y \o\m H:i')}}</small><br><br>
                      @auth
                      @if ($post->user_id == Auth::user()->id)
                        <a href="{{route('posts.edit', $post->id)}}">Edit post</a>
                      @else
                        <a href="{{route('like',$post->id)}}">Like post</a>
                      @endif
                      <br>
                      @endauth
                      Post heeft {{$post->likes()->count() }} likes


                      @auth
                       @if (Auth::user()->is_admin)
                        <br><br>
                        <form  action="{{route('posts.destroy',$post->id)}}"  method="post">
                          @csrf
                          @method('DELETE')
                          <input type="submit" value="DELETE POST" style="background-color: red;" onclick="return confirm('Are you sure ')">

                        </form>
                       @endif
                       @endauth


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
