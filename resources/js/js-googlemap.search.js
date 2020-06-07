      var map;
      var service;
      var infowindow;
      var currentInfoWindow = null; //インフォウィンドウの初期値


      initialize();   //初期状態の設定
      var searchBtn = document.getElementById("search");
      var initBtn = document.getElementById("init");
      var clearBtn = document.getElementById("clear");
      searchBtn.addEventListener("click",search,false);
      initBtn.addEventListener("click",initialize,false);
      clearBtn.addEventListener("click",inputValueClear,false);

      function initialize() {
        //現在地を中心とした地図を初期値として表示
        if (navigator.geolocation) {
                // 現在地を取得
                navigator.geolocation.getCurrentPosition(
                  // 取得成功した場合
                  function(position) {
                    // 緯度・経度を変数に格納
                    var pyrmont= new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                    // マップオブジェクト作成
                    map = new google.maps.Map(document.getElementById('map'), // マップを表示する要素
                      {zoom : 15,          // 拡大倍率
                      center : pyrmont // 緯度・経度
                    }
                    );
                    nearbySearch(pyrmont);
                  },
                  // 取得失敗した場合
                  function(error) {
                    // エラーメッセージを表示
                    switch(error.code) {
                      case 1: // PERMISSION_DENIED
                        alert("位置情報の利用が許可されていません");
                       // 緯度・経度を変数に格納(東京駅)
                   　　　var pyrmont = new google.maps.LatLng(35.681236,139.767125);
                       // マップオブジェクト作成
                    　　　　map = new google.maps.Map(document.getElementById('map'), // マップを表示する要素
                         {zoom : 15,// 拡大倍率
                          center : pyrmont // 緯度・経度
                         }
                        );
                       nearbySearch(pyrmont);
                        break;
                      case 2: // POSITION_UNAVAILABLE
                        alert("現在位置が取得できませんでした");
                          // 緯度・経度を変数に格納（東京駅）
                   　　　var pyrmont = new google.maps.LatLng(35.681236,139.767125);
                    　　　　// マップオブジ���クト作成
                    　　　　map = new google.maps.Map(document.getElementById('map'), // マップを表示する要素
                          {zoom : 15,          // 拡大倍率
                          center:pyrmont//緯度・経度
                    　　　}
                          );
                         nearbySearch(pyrmont);
                        break;
                      case 3: // TIMEOUT
                        alert("タイムアウトになりました");
                        break;
                      default:
                        alert("その他のエラー(エラーコード:"+error.code+")");
                        break;
                    }
                  }
                );
              // Geolocation APIに対応していない
              } else {
                alert("この端末では位置情報が取得できません");
              }
       }

      //検索窓で検索し、中央位置を設定する→半径1500m内の本屋さんを検索
      function search(){
        var geocoder = new google.maps.Geocoder();

        document.getElementById('search').addEventListener('click',function(){
          geocoder.geocode({
             address:document.getElementById('keyword').value
          },function(resultsGeo,statusGeo){
            if(statusGeo == google.maps.GeocoderStatus.OK){
           
              var pyrmont = resultsGeo[0].geometry.location;
             

              // 位置座標のインスタンスを作成する
              map = new google.maps.Map(document.getElementById('map'), {
                  center: pyrmont,
                  zoom: 15
                });

              nearbySearch(pyrmont);
              //createMarker();
            }else if(statusGeo == google.maps.GeocoderStatus.ZERO_RESULTS){
              alert("見つかりません");
            }else{
              console.log(statusGeo);
              alert("エラー発生");
            }

          });
        });
      }


      function createMarker(latlng,icn,placename)
      {
       // マーカー作成 https://developers.google.com/maps/documentation/javascript/examples/marker-simple 参照
        var marker = new google.maps.Marker({
          position: latlng,
          map: map,
        });

        
        var infowindow = new google.maps.InfoWindow({
          
          content: placename
        });


       marker.addListener('click',function(){
         //マーカーをクリックした際に、既に吹き出し表示されている場合はクローズ 2020.05.19
         if(currentInfoWindow){
           currentInfoWindow.close();
         }
         map.setCenter(latlng);
        
         infowindow.open(map,marker);
         currentInfoWindow = infowindow;
         
         document.getElementById('place').value=placename;
        
         clickAddress(latlng);
       });

      }


      //クリックした時に住所情報を取得 2020.05.20
      function clickAddress(latlng){
      //住所を出力
      var geocoder = new google.maps.Geocoder();
      geocoder.geocode(
        {location:latlng},function(res,sta){
          if(sta == google.maps.GeocoderStatus.OK){
           
            var address = res[0].address_components;//都道府県名
            var pref = address[address.length-3].long_name;
            document.getElementById('pref').value=pref;
           
            regionJudge(pref);

            var addressCity = res[0].formatted_address;//住所
            addressCity = addressCity.substring(addressCity.indexOf(pref));
            document.getElementById('address').value=addressCity;
           
            
          }
          
        });

      }

      function regionJudge(pref){
        var region = document.getElementById("region");
        if(pref=="北海道" || pref=="青森県" || pref=="岩手県" ||pref=="秋田県"||pref=="山形県"||pref=="福島県"){
          region.value = "北海道・東北";
        }else if(pref=="茨城県"||pref=="栃木県"||pref=="群馬県"||pref=="埼玉県"||pref=="千葉県"||pref=="東京都"||pref=="神奈川県"){
          region.value= "関東";
        }else if(pref=="新潟県"||pref=="富山県"||pref=="石川県"||pref=="福井県"||pref=="山梨県"||
        pref=="長野県"||pref=="岐阜県"||pref=="静岡県"||pref=="愛知県"){
          region.value ="中部";
        }else if(pref=="三重県"||pref=="滋賀県"||pref=="京都府"||pref=="大阪府"||pref=="兵庫県"||
        pref=="奈良県"||pref=="和歌山県"){
          region.value = "近畿";
        }else if(pref=="鳥取県"||pref=="島根県"||pref=="岡山県"||pref=="広島県"||pref=="山口県"||
        pref=="徳島県"||pref=="香川県"||pref=="愛媛県"||pref=="高知県"){
          region.value = "中国・四国";
        }else{
          region.value = "九州・沖縄";
        }
      }

     function inputValueClear(){
       if(document.getElementById("keyword").value !== '' ||document.getElementById("keyword").value !==null){
                document.getElementById("keyword").value = '';
         }
       if(document.getElementById("place").value !== '' ||document.getElementById("place").value !==null){
                document.getElementById("place").value = '';
         }
       if(document.getElementById("pref").value !== '' ||document.getElementById("pref").value !==null){
                document.getElementById("pref").value = '';
         }
       if(document.getElementById("region").value !== '' ||document.getElementById("region").value !==null){
                document.getElementById("region").value = '';
         }
       if(document.getElementById("address").value !== '' ||document.getElementById("address").value !==null){
                document.getElementById("address").value = '';
         }
     
     }


   function nearbySearch(pyrmont){

     //指定位置の半径1500m内の書店を検索
      var request = {
        location: pyrmont,
        radius: '1500',
        type: ['book_store'] // https://developers.google.com/places/supported_types 参照
      };
      service = new google.maps.places.PlacesService(map);
      service.nearbySearch(request, callback);

      function callback(results, status) {
        if (status == google.maps.places.PlacesServiceStatus.OK) {
          for (var i = 0; i < results.length; i++) {
            var place = results[i];
            //console.log(place);
            latlng = place.geometry.location;
            icn = place.icon;
            placename=place.name;

            createMarker(latlng,icn,placename);
          }
        }
       }
      }