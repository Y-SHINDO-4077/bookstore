@extends('layouts.admin')

@section('title','リストを新規作成する')

 
         
@section('content')
 <div class="container">
     <div class="row">
    　<div class="mx-auto">
       <div class="col-md-10">
             <h2>新規作成</h2>
       </div>
      
      <div id="map" style="height: 500px; width: 720px; margin: 2rem auto 0;"></div>

    <!--検索窓-->
    <div class="col-md-12" style="text-align:center;">
      <div class="form-group form-inline">
          <input type="text" class="col-md-5 form-control" class="form-control" id="keyword">
          <button type="button" id="search" class="btn btn-outline-secondary">検索</button>
          <button id="init" class="btn btn-outline-success"><span style="color:blue;cursor:pointer;">地図の状態を初期化</span></a>
      <button id="clear" class="btn btn-outline-info"><span style="color:blue;cursor:pointer;">入力内容削除</span></a>
      </div>
    </div>
        
      <label class="col-form-label"><span style="color:red"> * </span>は必須項目です。</label>  
    　<form method="POST" enctype="multipart/form-data" action="{{action('User\ListController@create')}}">
    　   @if(count($errors)>0)
    　        @foreach($errors->all() as $message)
              <p class="bg-danger">{{ $message }}</p>
             @endforeach
    　        @endif
       <div class="flex-column">
         <div class="align-items-center">  
         <!--場所-->
         <div class="col-md-10 form-group">
            <label class="col-form-label">場所<span style="color:red"> * </span></label>
            <input type="text" class="form-control" placeholder="場所を入力してください" id="place" name="name" value="{{old('name')}}">
         </div>
         
         <!--地域名-->
         <div class="col-md-10 form-group">
            <label class="col-form-label" for="region">地域名<span style="color:red"> * </span></label>
            <input type="text" class="form-control" placeholder="地域名を入力してください" id="region" name="region" value="{{old('region')}}">
         </div>
         
         <!--都道府県名-->
         <div class="col-md-10 form-group">
            <label class="col-form-label" for="pref">都道府県名<span style="color:red"> * </span></label>
            <input type="text" class="form-control" placeholder="住所を入力してください" id="pref" name="pref" value="{{old('pref')}}">
         </div>
         
         <!--住所-->
         <div class="col-md-10 form-group">
            <label class="col-form-label" for="address">住所<span style="color:red"> * </span></label>
            <input type="text" class="form-control" placeholder="住所を入力してください" id="address" name="address" value="{{old('address')}}">
         </div>
         
         <!--緯度・経度-->
         <input type="hidden"  id="lat" name="lat">
         <input type="hidden"  id="lng" name="lng">
         
         <!--画像選択 -->
         <div class="col-md-10  form-group">
             <lavel class="col-form-label" for="image">画像</lavel>
             <input type="file" class="form-control-file" name="image">
         </div>
         
         
         <!--ハンドルネーム-->
          <div class="col-md-10 form-group">
            <label class="col-form-label" for="inputDefaultHandle">ハンドルネーム</label>
            <input type="text" class="form-control" placeholder="ハンドルネームを入力してください" id="handle_name" name="handdle_name" value="{{old('handdle_name')}}">
          </div>   
          
          <!--お気に入りコメント--> 
          <div class="col-md-10 form-group">
            <label class="col-form-label col-form-label-lg" for="inputDefaultComment">お気に入りコメント</label>
            <input class="form-control form-control-lg" type="text" placeholder="コメントを入力してください" id="comment" name="comment" value="{{old('comment')}}">
　　　　　</div>
　　　　　
　　　　　<div class="col-md-10 form-group">
　　　　　    {{ csrf_field()}}
　　　　   　<button type="submit" class="btn btn-primary float-left">登録</button>
　　　　　</div>
　　　　　
         </div> 
         <div class="col-md-10 form-group">
         <button type="button" class="btn btn-secondary float-right"><a href="{{ action('User\ListController@list') }}" style="color:white">戻る</a></button>
         </div>
       </div>
      </form> 
      </div> 
     </div>
 </div>
@endsection
@section('footer')
<!-- google map api --> 
<script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnd2sgN1VYg7ZgdNL27zkzWkTS8mRdOCk&libraries=places"></script>
<script defer type="text/javascript" src="{{asset('js/js-googlemap.search.js')}}"></script>
@endsection