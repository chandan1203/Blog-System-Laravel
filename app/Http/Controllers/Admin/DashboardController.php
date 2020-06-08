<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Post;
use App\Category;
use App\Tag;
use App\User;

class DashboardController extends Controller
{
    public function index()
    {
    	$posts = Post::all();
    	$popular_post = Post::withCount('comments')
    						->withCount('favourite_to_users')
    						->orderBy('view_count','desc')
    						->orderBy('comments_count','desc')
    						->orderBy('favourite_to_users_count','desc')
    						->take(10)->get();
        $total_pending_post = Post::where('is_approved',false)->count();
        $total_views = Post::sum('view_count');
        $all_categories = Category::all()->count();
        $all_tags = Tag::all()->count();
        $total_authors = User::where('role_id',2)->count();
        $today_authors = User::where('role_id',2)
                    ->whereDate('created_at',Carbon::today())->count();
    	return view('admin.dashboard',compact('posts','popular_post','total_pending_post','total_views','all_categories','all_tags','total_authors','today_authors'));
    }
}
