@extends('layouts.admin')

@section('title','リスト一覧を見る')

@section('content')
 <div class="container">
    <div class="row">
    <div class="mx-auto">
       <div class="col-md-10">
             <h2>ログイン後一覧</h2>
       </div>
       
      <div id="map" style="height: 500px; width:720px; margin: 2rem auto 0;"></div>
      
     <div class="col-md-12" style="display:inline-block;">
     
        <a type="button" href="{{action('Admin\ListController@add')}}" class="btn btn-primary">新規作成</a>
        
        <form class="form-inline my-lg-0"　action="{{ action('ListController@list') }}" method="get"> 
         <label class="col-form-label col-md-3" for="custom-select">地域名</label>
            <select class="custom-select col-md-8" name="region" id="region">
              <option selected="selected" value="">地域名を選択してください</option>
              <option value="北海道・東北" @if($region=='北海道・東北') selected @endif>北海道・東北</option>
              <option value="関東" @if($region=='関東') selected @endif>関東</option>
              <option value="中部" @if($region=='中部') selected @endif>中部</option>
              <option value="近畿" @if($region=='近畿') selected @endif>近畿</option>
              <option value="中国・四国" @if($region=='中国・四国') selected @endif>中国・四国</option>
              <option value="九州・沖縄" @if($region=='九州・沖縄') selected @endif>九州・沖縄</option>
            </select>
         <label class="col-form-label col-md-3" for="custom-select">場所名検索</label> 
           <input class="form-control col-md-7" type="text" placeholder="場所名を入力してください" name="name" value={{$name}}>
           <button class="btn btn-secondary my-2 my-sm-0" type="submit">検索</button>
       </form>
      </div> 
    </div>
    </div> 
   
   
   <div class="row">
    <div class="col-md-12 d-flex justify-content-around flex-wrap">
        @foreach($bookstores as $bs)
          <div class="card border-light col-lg-4 mx-3 my-3" style="max-width: 20rem; max-height:45rem; text-align:center;">
             <div class="card-header">{{$bs->name}}</div>
              
                  @if($bs->image_path != null)
            <img class="card-img mx-auto" src="{{ asset('/storage/image/'.$bs->image_path) }}" style="width:40%;height:40%;display:clock;">
            <div class="card-body" style="position:relative;">
              <div class="card-img-overlay"> 
                <p class="card-text" style="position:absolute; top:10px;">{{$bs->address}}</p>
              </div>
            </div> 
            @else
            <div class="card-body">
              <p class="card-text">{{$bs->address}}</p>
            </div> 
            @endif
             <div class="list-group list-group-flush">
             コメント数:{{$count[$bs->id]}}
              </div>  
             
               
             <div class="card-footer">
                 <!--<button type="button" class="btn btn-info">本屋情報編集</button>-->
                <!--<button type="button" class="btn btn-warning"><a href="{{ action('Admin\ListController@detail',['id'=>$bs->id]) }}" style="color:white">コメント追加</a></button>-->
                <button type="button" class="btn btn-info"><a href="{{ action('Admin\ListController@detail',['id'=>$bs->id]) }}" style="color:white">詳細</a></button>
              </div>
          </div>
         @endforeach
    </div>
     @if($name=='')
    <div class="paginate pagenate-lg mx-auto">
      {!! $bookstores->appends(['region'=>$region,'name'=>$name])->render() !!} 
      {{--appendsメゾットでペジネーションのための文字列・変数を配列で入れる、render()で他のページへのリンクを作る、render()使用時には!!が前後に必要 --}}
    </div>
    @endif
   </div>
   
 </div>
@endsection 
@section('footer')
    <!-- jqueryの読み込む -->
    <script async src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- google map api -->
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnd2sgN1VYg7ZgdNL27zkzWkTS8mRdOCk&libraries=places"></script>
    
    <script type="text/javascript">
     var currentInfoWindow = null; //インフォウィンドウの初期値
$(function(){
  //XMLファイル読み込む
      $.ajax({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
     url:"/admin/sqlToXML",
    //url:"./XMLtoAjax",
    type:"get",
    cache:false,
    dataType:"xml"
   }).done(function(xml){
       //alert('success');
       var data=xmlRequest(xml);
       //console.log(data);
       initialize(data);
    }).fail(function(XMLHttpRequest,textStatus,errorThrown){
       alert('fail');
       console.log("XMLHttpRequest : " + XMLHttpRequest.status);
　　   console.log("textStatus     : " + textStatus);
　　   console.log("errorThrown    : " + errorThrown.message);
     });

//XMLファイル読み込み
function xmlRequest(xml){
  var data = [];
  $(xml).find("markers > marker").each(function(){
    var dat={};
    dat.name = this.getAttribute('name');
    dat.address = this.getAttribute('address');
    //dat.lat = this.getAttribute('lat');
    //dat.lng = this.getAttribute('lng');
    dat.pref = this.getAttribute('pref');
    dat.region = this.getAttribute('region');
    $(this).children().each(function(){
      if(this.childNodes.length>0)dat[this.tagName]
      =this.childNodes[0].nodeValue;
    });
    data.push(dat);
  });
  //alert('data');
  return data;
}


function createMarker(map,name,address,pref,region,iw){
  // ジオコーダのコンストラクタ
  var geocoder = new google.maps.Geocoder();
  
  geocoder.geocode({address:address},function(results,status){
    if(status==google.maps.GeocoderStatus.OK){
  
      lat = results[0].geometry.location.lat();
      
      lat = parseFloat(lat);
      lng = results[0].geometry.location.lng();
      lng = parseFloat(lng);
     

    latlng = new google.maps.LatLng(lat,lng);
 　 var marker = new google.maps.Marker({
    position:latlng,
    map:map,
     });
     //console.log(latlng);

    marker.addListener('click',
    function(){
    if(currentInfoWindow){
    currentInfoWindow.close();
    }

  
    map.setCenter(latlng);
    //console.log(latlng);
  
    iw.open(map,marker);
  
    currentInfoWindow = iw;

    });
   }else if(status =="OVER_QUERY_LIMIT") {
       //status =="OVER_LIMIT_QUERY"対策用、setTimeoutを用いて遅延して関数を読み出す 2020.06.10
       setTimeout(function () {
                       //再帰的に200ミリ秒後createMarker関数を呼び出す
                       createMarker(map,name,address,pref,region,iw);
                   }, 200);
        //alert('Geocode was not successful for the following reason: ' + status);
 }
 else{
    alert('Geocode was not successful for the following reason: ' + status); 
 }
  });
 }


function initialize(data){
  var map = new google.maps.Map(document.getElementById("map"),{
    zoom:5,
    center:new google.maps.LatLng(37.098403,137.985031),//糸魚川市
   
  });
  if(data != null){
    var i = data.length;
  
  }

  while(i-->0){
    var dat = data[i];
    
    var name=dat.name;
   
    var address = dat.address;
    var pref =dat.pref;
    var region =dat.region;
    var iw=new google.maps.InfoWindow({content:name});

    createMarker(map,name,address,pref,region,iw);
  
  }
}     
});
</script>
@endsection
      