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

//本登録メール
Auth::routes(['verify' =>'true']);

/* admin画面の場合に呼び出す */

Route::group(['prefix' => 'admin'],function(){
   Route::get('list_detail/register','Admin\ListController@add')->middleware('auth'); 
   Route::get('home','Admin\ListController@index')->middleware('auth'); 
   Route::get('/about','Admin\ListController@about')->middleware('auth'); 
   Route::get('/list','Admin\ListController@list')->middleware('auth'); 
});
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->middleware('verified');


// //本登録メール
// Route::middleware('verified')->group(function(){
//     Route::get('verified',function(){
//         return '本登録が完了しています。';
//     });
// });
// Route::middleware('verified')->group(function () {
//     Route::group(['middleware' => 'auth:user'], function () {
//         // メール認証済みかつログイン済みのユーザーが見れる画面
//         Route::get('/home', 'HomeController@index')->name('home');
//     });
// });

Route::get('/','ListController@index');
Route::get('/about','ListController@about');
Route::get('/list','ListController@list');

Route::get('/html',function(){
    return  \File::get(public_path() . '/googlemap.html');
});