<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;
use Auth;
use Illuminate\Support\Facades\Hash;
class SettingsController extends Controller
{
    public function index()
    {
    	return view('author.settings');
    }

    public function UpdateProfile(Request $request)
    {
    	$this->validate($request,[
    		'name' =>'required',
    		'email' => 'required',
    		'image' => 'required'
    	]);
    	$image = $request->file('image');
    	$slug = str_slug($request->name);
    	$user = User::find(Auth::id());
    	if (isset($image)) 
    	{
    		$currentDate = Carbon::now()->toDateString();
    		$imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
    		if (!Storage::disk('public')->exists('profile')) 
    		{
    			Storage::disk('public')->makeDirectory('profile');
    		}
    		if (Storage::disk('public')->exists('profile/'.$user->image)) 
    		{
    			Storage::disk('public')->delete('profile/'.$user->image);
    		}
    		$profile = Image::make($image)->resize(500,500)->stream();
    		Storage::disk('public')->put('profile/'.$imageName,$profile);
    	}else{
    		$imageName = $user->image;
    	}

    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->image = $imageName;
    	$user->about = $request->about;
    	$user->save();
    	Toastr::success('Author profile has been updated','Success');
    	return redirect()->back();
    }

    public function UpdatePassword(Request $request)
    {
    	$this->validate($request,[
    		'old_password' => 'required',
    		'password' => 'required|confirmed'
    	]);

    	$hashedPass = Auth::user()->password;
    	if (Hash::check($request->old_password,$hashedPass)) 
    	{
    		if (!Hash::check($request->password,$hashedPass)) 
    		{
    			$user = User::find(Auth::id());
    			$user->password = Hash::make($request->password);
    			$user->save();
    			Toastr::success('Author password has been updated','Success');
    			Auth::logout();
    			return redirect()->back();
    		}else{
    			Toastr::error('Old password is not same as New password','Error');
    			return redirect()->back();
    		}
    	}else{
    		Toastr::error('Old password is not match','Error');
    			return redirect()->back();
    	}
    }
}
