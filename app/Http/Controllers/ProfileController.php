<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function index($username)
    {
    	$user = User::where('username',$username)->first();
    	$posts = $user->posts()->Approved()->Published()->paginate(4);
    	return view('profile',compact('user','posts'));
    }
}
