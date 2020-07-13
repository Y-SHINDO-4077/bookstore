@extends('layouts.admin')

@section('title','Login/TOP')

@section('content')
   <div class="container">
       <div class="row">
           <div class="map mx-auto">
                <div id="map" style="height: 500px; width:100%; margin: 2rem auto 0;"></div>
           </div>
       </div>
   </div>
@endsection
@section('footer')
  <!-- jqueryの読み込む -->
    <script async src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- google map api -->
    <script async src="https://maps.googleapis.com/maps/api/js?key=&libraries=places"></script>
    
    <script type="text/javascript">
     var currentInfoWindow = null; //インフォウィンドウの初期値
$(function(){
  //XMLファイル読み込む
      $.ajax({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
     url:"/user/sqlToXML",
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