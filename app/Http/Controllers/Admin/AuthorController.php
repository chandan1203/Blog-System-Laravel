<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    public function index()
    {
    	$authors = User::Authors()
    			->withCount('posts')
    			->withCount('comments')
    			->withCount('favourite_posts')
    			->get();
    	return view('admin.authors',compact('authors'));
    }

    public function destroy($id)
    {

    	$user = User::findOrFail($id);
        if (Storage::disk('public')->exists('profile/'.$user->image)) 
        {
            Storage::disk('public')->delete('profile/'.$user->image);
        }
        $user->delete();
    	Toastr::success('Author delete successfully','Success');
		return redirect()->back();

    }
}
