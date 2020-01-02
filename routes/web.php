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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::resource('users', 'UserController');

Route::resource('links', 'LinkController');

Route::resource('images', 'ImageController');

Route::resource('avatars', 'AvatarController');

Route::resource('gitUsers', 'Git_userController');

Route::post('uploadImage', 'ImageController@postImages')->name('uploadImage');
Route::post('deleteImage', 'ImageController@destroyImages')->name('deleteImage');

Route::resource('texts', 'TextController');

Route::get('/home', 'HomeController@index');
Route::get('/', ['as' => 'home', 'uses' => 'Frontend\HomeController@index']);
Route::get('/get_file_name', ['as' => 'get_file_name', 'uses' => 'Frontend\HomeController@getImage']);