<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
    	$user = Auth::user();
    	$posts = $user->posts;
    	$popular_post = $user->posts()
    			->withCount('comments')
    			->withCount('favourite_to_users')
    			->orderBy('view_count','desc')
    			->orderBy('comments_count','desc')
    			->orderBy('favourite_to_users_count','desc')
    			->take(10)->get();
    	$total_pending_post = $posts->where('is_approved',false)->count();
    	$total_view = $posts->sum('view_count');
    	return view('author.dashboard',compact('user','posts','popular_post','total_pending_post','total_view'));
    }
}
