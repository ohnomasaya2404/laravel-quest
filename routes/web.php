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

Route::get('/','UsersController@index');

//ユーザ登録
Route::get('signup','Auth\RegisterController@showRegistrationForm')
->name('signup');
Route::post('signup','Auth\RegisterController@register')
->name('signup.post');


//ログイン機能

//ログインフォームを表示する
Route::get('login','Auth\LoginController@showloginForm')
->name('login');
//入力されたログインフォームの値をポストで送る
Route::post('login','Auth\LoginController@login')
->name('login.post');
//ログアウトさせる
Route::get('logout','Auth\LoginController@logout')
->name('logout');


Route::resource('users','UsersController',['only' =>['show']]);

Route::group(['prefix'=> 'users/{id}'],function(){
     Route::get('followings','UserController@followings')->name('followings');
     Route::get('followers','UserController@followers')->name('followers');
     
});
Route::group(['middleware' => 'auth'],function(){
     Route::put('users','UsersController@rename')->name('rename');
     Route::group([ 'prefix'=> 'users/{id}' ],function() {
            Route::post('follow','UserFollowController@store')->name('follow');
            Route::delete('unfollow','UserFollowController@destroy')->name('unfollow');
     
     });
     Route::resource('movies', 'MoviesController', ['only' => ['create', 'store', 'destroy']]);
   
});




