<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Comment;
use Brian2694\Toastr\Facades\Toastr;

class CommentController extends Controller
{
    public function comments()
    {
    	$posts = Auth::user()->posts;
    	return view('author.comments',compact('posts'));
    }

    public function destroy($id)
    {
    	$comment = Comment::findOrfail($id);
    	if ($comment->post->user->id == Auth::id()) 
    	{
    		$comment->delete();
    		Toastr::success('Comment Successfully deleted','Success');
    		return redirect()->back();
    	}
    	else
    	{
    		Toastr::error('You are not illigible to delete this!','Error');
    		return redirect()->back();

    	}
    	
        
    }
}
