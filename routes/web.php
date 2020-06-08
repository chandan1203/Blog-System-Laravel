<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','HomeController@index')->name('home');
Route::post('subscriber','SubscriberController@store')->name('subscribe');

Route::get('posts','PostController@all_post')->name('all.posts');

Route::get('post-details/{slug}','PostController@index')->name('post.details');
Route::get('category/{slug}','PostController@categoryBypost')->name('category.posts');
Route::get('tag/{slug}','PostController@tagBypost')->name('tag.posts');
Route::get('search','SearchController@search')->name('search');

Route::get('profile/{username}','ProfileController@index')->name('profile.details');


Auth::routes();

Route::group(['middleware' => ['auth']],function(){
	Route::post('add-favorite/{post}','FavouriteController@add')->name('add.favorite');
	Route::post('comment/{post}','CommentController@store')->name('comment.store');
});

Route::group(['as'=>'admin.','prefix' => 'admin', 'namespace' => 'Admin','middleware' => ['auth', 'admin']],function(){

	Route::get('dashboard','DashboardController@index')->name('dashboard');
	Route::get('settings','SettingsController@index')->name('settings');
	Route::put('update-profile','SettingsController@UpdateProfile')->name('profile.update');

	Route::put('password-update','SettingsController@UpdatePassword')->name('password.update');

	Route::get('favorite/post','FavoriteController@index')->name('favorite.post');

	Route::resource('tag','TagController');
	Route::resource('category','CategoryController');
	Route::resource('post','PostController');
	Route::get('back','PostController@back')->name('post.back');
	Route::get('pending/post','PostController@pending')->name('post.pending');
	Route::put('post/{id}/approve','PostController@approval')->name('post.approval');
	Route::get('comments','CommentController@comments')->name('all.comments');
	Route::delete('comments/{id}','CommentController@destroy')->name('comment.destroy');

	Route::get('/subscriber','SubscriberController@index')->name('subscriber.index');
	Route::delete('/subscriber/{id}','SubscriberController@destroy')->name('subscriber.destroy');

	Route::get('authors','AuthorController@index')->name('author.index');
	Route::delete('authors/{id}','AuthorController@destroy')->name('author.destroy');



});

Route::group(['as'=>'author.','prefix' => 'author', 'namespace' => 'Author','middleware' => ['auth', 'author']],function(){

	Route::get('dashboard','DashboardController@index')->name('dashboard');
	Route::get('settings','SettingsController@index')->name('settings');
	Route::put('profile-update','SettingsController@UpdateProfile')->name('profile.update');
	Route::put('password-update','SettingsController@UpdatePassword')->name('password.update');
	Route::get('favorite/post','FavoriteController@index')->name('favorite.post');
	Route::get('comments','CommentController@comments')->name('all.comments');
	Route::delete('comments/{id}','CommentController@destroy')->name('comment.destroy');
	Route::resource('post','PostController');



});

View::composer('layouts.frontend.partial.footer',function($view){
	$categories = App\Category::all();
	$view->with('categories',$categories);

});