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
   Route::post('/list_detail/register','Admin\ListController@create')->middleware('auth');  //2020.05.28 登録処理
   Route::get('/sqlToXML','Admin\ListController@sqlToXML')->middleware('auth');//2020.06.01 xml確認
   Route::get('/list_detail/detail_comment/{id?}','Admin\ListController@detail')->middleware('auth');//2020.06.05 詳細ボタン押下後
   Route::post('/list_detail/detail_comment/{id?}','Admin\ListController@commentInsert')->middleware('auth');//2020.06.05 コメント追加登録後
});
Auth::routes();

/*ログインされていない場合 */
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

//html方式表示確認 2020.05.25
Route::get('/html',function(){
    return  \File::get(resource_path() . '/views/googlemap.html');
});
//xml生成確認 2020.05.29
Route::get('/list/sqlToXML','ListController@sqlToXML');

//詳細画面に遷移 2020.06.04
Route::get('/list/list_detail/{id}','ListController@detail');