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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/chat', 'ChatController@index')->name('chat');
Route::post('/store', 'ChatController@store')->name('store');
Route::resource('/messages', 'MessageController');
Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');
Route::post('/file_store', 'HomeController@storeFile')->name('file_store');
Route::get('/video', "VideoRoomsController@index")->name('video');
Route::prefix('room')->middleware('auth')->group(function() {
   Route::get('join/{roomName}', 'VideoRoomsController@joinRoom');
   Route::post('create', 'VideoRoomsController@createRoom');
});
