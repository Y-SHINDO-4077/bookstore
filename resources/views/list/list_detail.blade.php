@extends('layouts.front')

@section('title','詳細画面')

 
         
@section('content')
 <div class="container">
     <div class="row">
    　<div class="mx-auto">
       <div class="col-md-10">
             <h2>詳細</h2>
       </div>
      
      <div id="map" style="height: 500px; width: 720px; margin: 2rem auto 0;"></div>

       <div class="flex-column">
         <div class="align-items-center">  
         <!--場所-->
         <div class="col-md-10">
            <label class="col-form-label">場所</label>
            <div class="col-md-8 ml-auto">{{$bs->name}}</div>
            
         </div>
         
         <!--地域名-->
         <div class="col-md-10">
            <label class="col-form-label" for="region">地域名</label>
            <div class="col-md-8 ml-auto">{{$bs->region}}</div>
         </div>
         
         <!--都道府県名-->
         <div class="col-md-10">
            <label class="col-form-label" for="pref">都道府県名</label>
            <div class="col-md-8 ml-auto">{{$bs->pref}}</div>
           
         </div>
         
         <!--住所-->
         <div class="col-md-10">
            <label class="col-form-label" for="address">住所</label>
            <div class="col-md-8 ml-auto">{{$bs->address}}</div>
           
         </div>
         
        
         
         <!--画像選択 -->
         <div class="col-md-10">
             <lavel class="col-form-label" for="image">画像</lavel>
             <div class="col-md-8 ml-auto">
             @if($bs->image_path != null)
             <img src="{{ asset('storage/image/' . $bs->image_path) }}" alt="image_path" style="width:50%;height:50%;">
             @endif
             </div>
         </div>
        </div> 
         
        
         <!--ハンドルネーム-->
          <div class="col-md-10">
           
            @foreach($cm as $data)
            <hr class="col-md-12" style="border-top:double;">
            <div class="d-flex justify-content-between">
            <div class="float-left">
            <label class="col-form-label" for="inputDefaultHandle">ハンドルネーム</label>
            <p>{{$data->handdle_name}}</p>
            </div>
            <div class="float-right">
            <label class="col-form-label" for="inputDefaultHandle">投稿日時</label>
            <p>{{$data->created_at->format('Y年m月d日 H:m')}}</p>
            </div>
            </div>
         
          
          <!--お気に入りコメント--> 
          
            <label class="col-form-label " for="inputDefaultComment">お気に入りコメント</label>
            <p class="col-form-label-lg">{{$data->comment}}</p>
          
            @endforeach  
      
　　　　　</div>
　　　　　
　　　　　
　　　　　</div>
　　　　　
          <button type="button" class="btn btn-secondary"><a href="{{ action('ListController@list') }}" style="color:white">戻る</a></button>
       </div>
 
      
      　　
      </div> 
  </div>
 
@endsection