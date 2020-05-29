<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListController extends Controller
{
    public function index(){
        return view('list.index');
    }
    public function about(){
        return view('list.about');
    }
    public function list(){
        return view('list.list');
    }
   
}
