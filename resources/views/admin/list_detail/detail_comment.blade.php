@extends('layouts.admin')

@section('title','コメント入力')

 
         
@section('content')
 <div class="container">
     <div class="row">
    　<div class="mx-auto">
       <div class="col-md-10">
             <h2>詳細コメント</h2>
       </div>
      
      <div id="map" style="height: 500px; width: 720px; margin: 2rem auto 0;"></div>
       <!--IDをhiddenで取得、ajax通信で該当するidのみを読み込む -->
       <input type="hidden" id="store_id" value="{{$bs->id}}">
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
　　　　　
　　　　<form method="POST" action="{{action('Admin\ListController@commentInsert')}}">
　　　　   <input type="hidden" name="store_id" value="{{$bs->id}}">
             @if(count($errors)>0)
    　        @foreach($errors->all() as $message)
              <p class="bg-danger">{{ $message }}</p>
             @endforeach
    　        @endif
　　　　  <!--<div class="col-md-10">-->
　　　　　  <!--<hr class="col-md-12" style="border-top:double;">-->
　　　　　<!--ハンドルネーム-->
             <div class="col-md-10 form-group">
              <label class="col-form-label" for="inputDefaultHandle">ハンドルネーム<span style="color:red"> * </span></label>
              <input type="text" class="form-control" placeholder="ハンドルネームを入力してください" id="handle_name" name="handdle_name">
             </div>   
          
          <!--お気に入りコメント--> 
             <div class="col-md-10 form-group">
              <label class="col-form-label col-form-label-lg" for="inputDefaultComment">お気に入りコメント<span style="color:red"> * </span></label>
              <input class="form-control form-control-lg" type="text" placeholder="コメントを入力してください" id="comment" name="comment">
　　　　　   </div>
　　　　　
　　　　　   <div class="col-md-10 form-group">
　　　　　      {{ csrf_field()}}
　　　　   　   <button type="submit" class="btn btn-primary float-left">登録</button>
　　　　　   </div>
　　　　　<!--</div>-->
　　　　</form>
　　　　　
　　　　</div>
　　　　
　　　　　<div class="col-md-10">
          <button type="button" class="btn btn-secondary float-right"><a href="{{ action('Admin\ListController@list') }}" style="color:white">戻る</a></button>
          </div>
       </div>
 
      
      　　
      </div> 
  </div>
 
@endsection
@section('footer')
    <!-- jqueryの読み込む -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- google map api -->
    <script src="https://maps.googleapis.com/maps/api/js?key=&libraries=places"></script>
    <script type="text/javascript">
    var currentInfoWindow = null; //インフォウィンドウの初期値
    var id =document.getElementById('store_id').value;
$(function(){
  //XMLファイル読み込む
  $.ajax({
     headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
    url:"../../sqlToXML",
    type:"get",
    cache:false,
    dataType:"xml"
  })
    .done(function(xml){
       var data=xmlRequest(xml);
       initialize(data);
     })
     .fail(function(XMLHttpRequest,textStatus,errorThrown){
       alert('fail');
       console.log("XMLHttpRequest : " + XMLHttpRequest.status);
　　    console.log("textStatus     : " + textStatus);
　　    console.log("errorThrown    : " + errorThrown.message);
      })
   });

//XMLファイル読み込み
function xmlRequest(xml){
  var data = [];
  $(xml).find("markers > marker").each(function(){
    var dat={};
    dat.id = this.getAttribute('id');
    dat.name = this.getAttribute('name');
    dat.address = this.getAttribute('address');
    dat.pref = this.getAttribute('pref');
    dat.region = this.getAttribute('region');
    $(this).children().each(function(){
      if(this.childNodes.length>0)dat[this.tagName]
      =this.childNodes[0].nodeValue;
    });
    if(dat.id==id){
    data.push(dat);
  }
  });
 
  return data;
}

function initialize(data){
  var name=data[0].name;
  var address = data[0].address;
  var pref =data[0].pref;
  var region =data[0].region;
  var iw=new google.maps.InfoWindow({content:name});

  // ジオコーダのコンストラクタ
  var geocoder = new google.maps.Geocoder();
  //console.log(geocoder);
  geocoder.geocode({address:address},function(results,status){
    if(status==google.maps.GeocoderStatus.OK){

      var lat = results[0].geometry.location.lat();
      lat = parseFloat(lat);
      var lng = results[0].geometry.location.lng();
      lng = parseFloat(lng);
    var latlng = new google.maps.LatLng(lat,lng);
    var map = new google.maps.Map(document.getElementById("map"),{
      zoom:15,
      center:latlng,
    });
  var marker = new google.maps.Marker({
    position:latlng,
    map:map,
  });

  marker.addListener('click',
  function(){
  if(currentInfoWindow){
    currentInfoWindow.close();
  }

  map.setCenter(latlng);
  iw.open(map,marker);
  currentInfoWindow = iw;
  document.getElementById("place").innerHTML=name;
  document.getElementById("address").innerHTML=address;
  document.getElementById("pref").innerHTML=pref;
  document.getElementById("region").innerHTML=region;
    });
   }
  });
}
</script>
@endsection