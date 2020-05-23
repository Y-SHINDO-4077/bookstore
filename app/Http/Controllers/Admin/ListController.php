<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListController extends Controller
{  
    /*新規登録画面へ遷移*/
    public function add()
    {
      return view('admin.list_detail.register');    
    }
    
    /*新規登録画面で入力した内容を保存 */
    public function create()
    {
      return redirect('admin/list_detail/register');
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
