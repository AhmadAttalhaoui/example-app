@extends('layouts.app')

@section('content')

<div class="container my-3">
<h1>{{__('Make admin page')}}</h1>
<table class="table">
  <thead>
    <tr>
      <th scope="col">{{__('Name')}}</th>
      <th scope="col">{{__('Email')}}</th>
      <th scope="col">{{__('Make admin')}}</th>
    </tr>
  </thead>
  <tbody>
    
    @foreach($users as $user)

    <tr>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>
      <form action="/make_admin/{{$user->id}}" method="post">
      @method('PATCH')
      @csrf
      <button type="submit" class="btn btn-primary">Make admin</button>
      </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>

@endsection
