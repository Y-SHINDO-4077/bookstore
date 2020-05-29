@extends('layouts.admin')

@section('title','リスト一覧を見る')

@section('content')
 <div class="container">
    <div class="row">
    <div class="mx-auto">
       <div class="col-md-10">
             <h2>ログイン後一覧</h2>
       </div>
       
      <div id="map" style="height: 500px; width:500px; margin: 2rem auto 0;"></div>
      
     <div class="col-md-12" style="display:inline-block;">
     
        <a type="button" href="{{action('Admin\ListController@add')}}" class="btn btn-primary">新規作成</a>
         <br>
         <label class="col-form-label col-md-3" for="custom-select">地域名</label>
            <select class="custom-select col-md-8" name="region" id="region">
              <option selected="selected" class="msg">地域名を選択してください</option>
              <option value=0>北海道・東北</option>
              <option value=1>関東</option>
              <option value=2>中部</option>
              <option value=3>近畿</option>
              <option value=4>中国・四国</option>
              <option value=5>九州・沖縄</option>
            </select>
       
      <form class="form-inline my-lg-0">
         <label class="col-form-label col-md-3" for="custom-select">場所名検索</label> 
           <input class="form-control col-md-7" type="text" placeholder="場所名を入力してください">
           <button class="btn btn-secondary my-2 my-sm-0" type="submit">検索</button>
       </form>
      </div> 
 </div>
 
 </div>
 </div>
@endsection 
      