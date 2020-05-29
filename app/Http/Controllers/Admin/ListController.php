<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//2020.05.28
use App\Bookstores; 
use App\BookstoreHistory;
use Carbon\Carbon;  
use App\User;

class ListController extends Controller
{  
    /*新規登録画面へ遷移*/
    public function add()
    {
      return view('admin.list_detail.register_1');    
    }
    
    /*新規登録画面で入力した内容を保存 */
    public function create(Request $request)
    {
      $this->validate($request, Bookstores::$rules);
      //$bsid = Bookstores::find($request->id);
      //print $bsid;
      
      $bs = new Bookstores;
      
      $bs->name=$request->input('name');
      $bs->region=$request->input('region');
      $bs->pref=$request->input('pref');
      $bs->address=$request->input('address');
      
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $bs->image_path = basename($path);
      } else {
          $bs->image_path = null;
      }
      
      $bs->user_id='1';
      
      // フォームから送信されてきた_tokenを削除する
      unset($bs['_token']);
      // フォームから送信されてきたimageを削除する
      unset($bs['image']);
      
      $bs->save();
      
      $bsh= new BookstoreHistories;
      $bsh->bookstore_id = $request->input('id');
    
      $bsh->edited_at = Carbon::now();
      $bsh->save();

      return redirect('admin/list_detail/register');
      //return redirect('admin/list');
    }
    
    /*ログイン後、ログイン後のトップ画面に遷移 2020.05.17*/
    public function index(){
      return view('admin.home');
    }
    /*ログイン後、ログイン後のabout画面に遷移 2020.05.17*/
    public function about(){
      return view('admin.about');
    }
    /*ログイン後、ログイン後のlist画面に遷移 2020.05.20 */
    public function list(){
      return view('admin.list');
    }
    
}
