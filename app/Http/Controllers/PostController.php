<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Post;
use App\Category;
use App\Tag;
class PostController extends Controller
{
	public function all_post()
	{
		$posts = Post::latest()->Approved()->Published()->paginate(6);
		return view('all_posts',compact('posts'));
	}
    public function index($slug)
    {
    	$post = Post::where('slug',$slug)->first();
    	$blogKey = 'blog_'. $post->id;
    	if (!Session::has($blogKey)) 
    	{
    		$post->increment('view_count');
    		Session::put($blogKey,1);
    	}
    	$randomposts = Post::Approved()->Published()->take(3)->inRandomOrder()->get();
    	return view('post',compact('post','randomposts'));
    }

    public function categoryBypost($slug)
    {
        $category = category::where('slug',$slug)->first();
        $posts = $category->posts()->Approved()->Published()->get();
        return view('categoryPost',compact('category','posts'));
    }

    public function tagBypost($slug)
    {
        $tag = Tag::where('slug',$slug)->first();
        $posts = $tag->posts()->Approved()->Published()->get();
        return view('tagPost',compact('tag','posts'));
    }
}
