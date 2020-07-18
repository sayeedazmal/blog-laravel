<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home');

  Auth::routes();
  Route::get('/post','PostController@index')->name('post.show');
  Route::post('subscribe','Newsubscriber@store')->name('subscribe');
  Route::get('post/{slug}','PostController@details')->name('post.details');
  Route::get('category/{slug}','PostController@postByCategory')->name('category.post');
  Route::get('tags/{slug}','PostController@postByTags')->name('tags.post');
  Route::get('/search','searchController@search')->name('search');
  Route::get('profile/{username}','AuthorController@profile')->name('author.profile');


// Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>['auth']], function(){
  Route::post('favorite/{post}/add','FavouriteController@add')->name('post.favorite');
  Route::post('comments/{post}','CommentsController@store')->name('comment.store');

});

Route::group(['as'=>'admin.',
              'prefix'=>'admin',
              'namespace'=>'Admin',
              'middleware'=>['auth','admin']], function(){
              Route::get('deshboard','DeshboardController@index')->name('deshboard');
              Route::resource('tag','TagController');
              Route::resource('catagory','CatagoryController');
              Route::resource('post','PostController');

              Route::get('panding/post','PostController@panding')->name('post.panding');
              Route::put('/post/{id}/approve','PostController@approval')->name('post.approve');

              Route::get('/subscribe','SubscribeController@index')->name('subscribe.index');
              Route::delete('/subscribe/{subscribe}','SubscribeController@destroy')->name('subscribe.destroy');
              //Favorite routes
              Route::get('/favorite','FavoriteController@index')->name('favorite.index');
              //Comments route
              Route::get('comments/','CommentsController@index')->name('comment.index');
              Route::delete('/comments/{id}','CommentsController@destroy')->name('comment.destroy');

              Route::get('/authors','AuthorController@index')->name('author');
              Route::delete('/delete/{id}','AuthorController@destroy')->name('author.destroy');

              Route::get('settings','SettingController@index')->name('settings');
              Route::put('profile-update','SettingController@updateProfile')->name('profile.update');
              Route::put('password-update','SettingController@updatePassword')->name('password.update');

            });

Route::group(['as'=>'author.',
              'prefix'=>'author',
              'namespace'=>'Author',
              'middleware'=>['auth',
              'author']], function(){
              Route::get('deshboard','DeshboardController@index')->name('deshboard');
              Route::resource('post','PostController');
              Route::get('/favorite','FavoriteController@index')->name('favorite.index');

              Route::get('settings','SettingController@index')->name('settings');
              Route::put('profile-update','SettingController@updateProfile')->name('profile.update');
              Route::put('password-update','SettingController@updatePassword')->name('password.update');

              Route::get('comments/','CommentsController@index')->name('comment.index');
              Route::delete('/comments/{id}','CommentsController@destroy')->name('comment.destroy');
            });
    View::composer('layouts.Frontend.partial.footer', function ($view) {

        $categories = App\Catagory::all();
        $view->with('categories', $categories);

        });
