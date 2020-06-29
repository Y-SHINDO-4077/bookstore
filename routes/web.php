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

// Route::get('/', function () {
//     return view('welcome');
// });

//Auth::routes();

Route::post('register/pre_check', 'Auth\RegisterController@pre_check')->name('register.pre_check');
Route::post('register/pre_register', 'Auth\RegisterController@register')->name('pre_register');
//本登録メール
Auth::routes(['verify' => true]);
//Route::get('register/verify/{token}', 'Auth\RegisterController@showForm');

/* admin画面の場合に呼び出す ユーザー */

// Route::group(['prefix' => 'admin'],function(){
//   Route::get('list_detail/register','Admin\ListController@add')->middleware('auth'); 
//   Route::get('home','Admin\ListController@index')->middleware('auth'); 
//   Route::get('/about','Admin\ListController@about')->middleware('auth'); 
//   Route::get('/list','Admin\ListController@list')->middleware('auth'); 
//   Route::post('/list_detail/register','Admin\ListController@create')->middleware('auth');  //2020.05.28 登録処理
//   Route::get('/sqlToXML','Admin\ListController@sqlToXML')->middleware('auth');//2020.06.01 xml確認
//   Route::get('/list_detail/detail_comment/{id?}','Admin\ListController@detail')->middleware('auth');//2020.06.05 詳細ボタン押下後
//   Route::post('/list_detail/detail_comment/{id?}','Admin\ListController@commentInsert')->middleware('auth');//2020.06.05 コメント追加登録後
   
// });

Route::group(['prefix' => 'user'],function(){
   Route::get('list_detail/register','User\ListController@add')->middleware('auth'); 
   Route::get('/home','User\ListController@index')->middleware('auth'); 
   Route::get('/about','User\ListController@about')->middleware('auth'); 
   Route::get('/list','User\ListController@list')->middleware('auth'); 
   Route::post('/list_detail/register','User\ListController@create')->middleware('auth');  //2020.05.28 登録処理
   Route::get('/sqlToXML','User\ListController@sqlToXML')->middleware('auth');//2020.06.01 xml確認
   Route::get('/list_detail/detail_comment/{id?}','User\ListController@detail')->middleware('auth');//2020.06.05 詳細ボタン押下後
   Route::post('/list_detail/detail_comment/{id?}','User\ListController@commentInsert')->middleware('auth');//2020.06.05 コメント追加登録後
   //使い方画面へ遷移 2020.06.25
   Route::get('/howtouse','User\ListController@howtouse')->middleware('auth');
   
});
//Auth::routes();

/*ログインされていない場合 */
Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/home', 'HomeController@index')->middleware('verified')->name('home');


//本登録メール
// Route::middleware('verified')->group(function(){
//     Route::get('verified',function(){
//         return '本登録が完了しています。';
//     });
// });
//Route::middleware('verified')->group(function () {
    // Route::group(['middleware' => 'verified'], function () {
    //     // メール認証済みかつログイン済みのユーザーが見れる画面
    //     Route::get('/verified', function(){
    //     return view('auth.verify_main');
    //     })->middleware('verified')->name('auth.verify_main');
        //Route::get('/home', 'HomeController@index')->name('home');
//    });
//});

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

//使い方画面へ遷移 2020.06.16
Route::get('howtouse','ListController@howtouse');

/*管理者ログイン画面へ遷移 2020.06.16 */
//Route::get('/admin/login','Admin\Auth\LoginController@showLoginForm')->name('admin.loginpg');

//再送メール 2020.06.22
//Route::get('howtouse','ListController@howtouse')->name('register.resend');




/*ログイン画面リンクから管理画面に遷移 2020.06.12 */
// Route::group(['prefix'=>'admin','middleware'=>'guest:admin'],function(){
//  //Route::get('/login','AdministerController@admin'); //管理者ログイン画面
//   Route::get('/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.loginpg');
//   Route::post('/login','Admin\Auth\LoginController@login')->name('admin.login');
// });

// /*管理画面をログイン後 2020.06.15 */
// Route::group(['prefix'=>'admin','middleware'=>'auth:admin'],function(){
    
//   Route::post('logout','Admin\Auth\LoginController@logout')->name('admin.logout');
//   Route::get('login','Admin\HomeController@index')->name('admin.home');
// });

//2020.06.29 管理者用のとき、次に遷移
// Route::group(['middleware' => 'admin_auth'],function(){
//     Route::get('/admin/home','Admin\HomeController@index');
// });