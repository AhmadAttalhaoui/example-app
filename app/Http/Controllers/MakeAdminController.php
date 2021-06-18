<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Like;
use Auth;

class MakeAdminController extends Controller
{
    public function __construct()
    {

        $this->middleware('adminmiddleware');

    }

    public function make(){
        $users = User::where('isAdmin','0')->get();

        return view('user.make' ,compact('users'));
    }

    public function update($id){
        $user=User::findOrFail($id);
        // dd($user);
        $user->update(['isAdmin'=>'1']);

        return back();
    }
}
