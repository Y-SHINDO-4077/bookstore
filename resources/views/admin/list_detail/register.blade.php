@extends('layouts.admin')

@section('title','リストを新規作成する')

 <!--google map api -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=&libraries=places"></script>
<script async defer type="text/javascript" src="{{ secure_asset('js/js-googlemap.search.js') }}"></script>
         
@section('content')
 <div class="container">
     <div class="row">
    　<div class="mx-auto">
       <div class="col-md-10">
             <h2>新規作成</h2>
       </div>
      
      <div id="map" style="height: 500px; width: 500px; margin: 2rem auto 0;"></div>

    <!--検索窓-->
    <div style="text-align:center;">
      <input type="text" id="keyword">
      <button type="button" id="search">検索</button>
      <button id="init"><span style="color:blue;cursor:pointer;">地図の状態を初期化</span></a>
      <button id="clear"><span style="color:blue;cursor:pointer;">入力内容削除</span></a>
    </div>
        
    　　<!--<script src="{{ secure_asset('js/js-googlemap.search.js') }}" defer></script>-->
    　<form method="POST" enctype="multipart/form-data" action="#">
       <div class="flex-column">
         <div class="align-items-center">  
         <!--場所-->
         <div class="col-md-10 form-group">
            <label class="col-form-label">場所<span style="color:red"> * </span></label>
            <input type="text" class="form-control" placeholder="場所を入力してください" id="place" name="name">
         </div>
         
         <!--地域名-->
         <div class="col-md-10 form-group">
            <label class="col-form-label" for="region">地域名<span style="color:red"> * </span></label>
            <input type="text" class="form-control" placeholder="地域名を入力してください" id="region" name="region">
         </div>
         
         <!--都道府県名-->
         <div class="col-md-10 form-group">
            <label class="col-form-label" for="pref">都道府県名<span style="color:red"> * </span></label>
            <input type="text" class="form-control" placeholder="住所を入力してください" id="pref" name="pref">
         </div>
         
         <!--住所-->
         <div class="col-md-10 form-group">
            <label class="col-form-label" for="address">住所<span style="color:red"> * </span></label>
            <input type="text" class="form-control" placeholder="住所を入力してください" id="address" name="address">
         </div>
         
         <!--緯度・経度-->
         <input type="hidden"  id="lat" name="lat">
         <input type="hidden"  id="lng" name="lng">
         
         <!--画像選択 -->
         <div class="col-md-10  form-group">
             <button type="button" class="btn btn-secondary">選択</button>
             <label class="col-form-label">画像を選択</label>
         </div>
         
         <!--ハンドルネーム-->
          <div class="col-md-10 form-group">
            <label class="col-form-label" for="inputDefaultHandle">ハンドルネーム</label>
            <input type="text" class="form-control" placeholder="ハンドルネームを入力してください" id="inputDefaultHandle">
          </div>   
          
          <!--お気に入りコメント -->
          <div class="col-md-10 form-group">
            <label class="col-form-label col-form-label-lg" for="inputDefaultComment">お気に入りコメント</label>
  　　　　　　<input class="form-control form-control-lg" type="text" placeholder=".form-control-lg" id="inputLrcge">
　　　　　</div>
　　　　　
　　　　　<div class="col-md-10 form-group">
　　　　   　<button type="submit" class="btn btn-primary">登録</button>
　　　　　</div>
　　　　　
         </div>   
       </div>
      </form> 
      </div> 
     </div>
 </div>
@endsection
