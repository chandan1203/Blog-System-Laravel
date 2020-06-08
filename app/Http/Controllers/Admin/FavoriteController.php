<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class FavoriteController extends Controller
{
    public function index()
    {
    	$posts = Auth::user()->favourite_posts;
    	return view('admin.favorite',compact('posts'));
    }
}
