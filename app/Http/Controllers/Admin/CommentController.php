<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Comment;

class CommentController extends Controller
{
    public function comments()
    {
    	$comments = Comment::latest()->get();
    	return view('admin.comments',compact('comments'));
    }

    public function destroy($id)
    {
    	Comment::findOrfail($id)->delete();
    	Toastr::success('Comment Successfully deleted','Success');
        return redirect()->back();
    }
}
