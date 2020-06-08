<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Brian2694\Toastr\Facades\Toastr;

class FavouriteController extends Controller
{
	public function add($post)
	{
		$user = Auth::user();
		$isFavorite = $user->favourite_posts()->where('post_id',$post)->count();
		if ($isFavorite == 0) 
		{
			$user->favourite_posts()->attach($post);
			Toastr::success('Add your favorite post!','Success');
			return redirect()->back();
		}else{
			$user->favourite_posts()->detach($post);
			Toastr::success('Remove your favorite post!','Success');
			return redirect()->back();
		}
	}
}
