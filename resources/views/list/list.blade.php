@extends('layouts.front')

@section('title','リスト一覧を見る')

@section('content')
 <div class="container">
    <div class="row">
    <div class="mx-auto">
       <div class="col-md-10">
             <h2>一覧</h2>
       </div>
       
      <div id="map" style="height: 500px; width:500px; margin: 2rem auto 0;"></div>
      
     <div class="col-md-12" style="display:inline-block;">
 
         <br>
         <label class="col-form-label col-md-3" for="custom-select">地域名</label>
            <select class="custom-select col-md-8" name="region" id="region">
              <option selected="selected" class="msg">地域名を選択してください</option>
              <option class=0 value=0>北海道・東北</option>
              <option class=1 value=1>関東</option>
              <option class=2 value=2>中部</option>
              <option class=3 value=3>近畿</option>
              <option class=4 value=4>中国・四国</option>
              <option class=5 value=5>九州・沖縄</option>
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
      