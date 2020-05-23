/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/js-googlemap.search.js":
/*!*********************************************!*\
  !*** ./resources/js/js-googlemap.search.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var map;
var service;
var infowindow;
var currentInfoWindow = null; //インフォウィンドウの初期値

initialize(); //初期状態の設定

var searchBtn = document.getElementById("search");
var initBtn = document.getElementById("init");
var clearBtn = document.getElementById("clear");
searchBtn.addEventListener("click", search, false);
initBtn.addEventListener("click", initialize, false);
clearBtn.addEventListener("click", inputValueClear, false);

function initialize() {
  //現在地を中心とした地図を初期値として表示
  if (navigator.geolocation) {
    // 現在地を取得
    navigator.geolocation.getCurrentPosition( // 取得成功した場合
    function (position) {
      // 緯度・経度を変数に格納
      var pyrmont = new google.maps.LatLng(position.coords.latitude, position.coords.longitude); // マップオブジェクト作成

      map = new google.maps.Map(document.getElementById('map'), // マップを表示する要素
      {
        zoom: 15,
        // 拡大倍率
        center: pyrmont // 緯度・経度

      });
      nearbySearch(pyrmont);
    }, // 取得失敗した場合
    function (error) {
      // エラーメッセージを表示
      switch (error.code) {
        case 1:
          // PERMISSION_DENIED
          alert("位置情報の利用が許可されていません"); // 緯度・経度を変数に格納

          var pyrmont = new google.maps.LatLng(35.681236, 139.767125); // マップオブジェクト作成

          map = new google.maps.Map(document.getElementById('map'), // マップを表示する要素
          {
            zoom: 15,
            // 拡大倍率
            center: pyrmont // 緯度・経度

          });
          nearbySearch(pyrmont);
          break;

        case 2:
          // POSITION_UNAVAILABLE
          alert("現在位置が取得できませんでした"); // 緯度・経度を変数に格納

          var pyrmont = new google.maps.LatLng(35.681236, 139.767125); // マップオブジェクト作成

          map = new google.maps.Map(document.getElementById('map'), // マップを表示する要素
          {
            zoom: 15,
            // 拡大倍率
            center: pyrmont // 緯度・経度

          });
          nearbySearch(pyrmont);
          break;

        case 3:
          // TIMEOUT
          alert("タイムアウトになりました");
          break;

        default:
          alert("その他のエラー(エラーコード:" + error.code + ")");
          break;
      }
    }); // Geolocation APIに対応していない
  } else {
    alert("この端末では位置情報が取得できません");
  } // 位置座標のインスタンスを作成する
  //var pyrmont = new google.maps.LatLng(35.0441263,135.7873418); //京都市左京区一乗寺駅周辺
  //map = new google.maps.Map(document.getElementById('map'), {
  //    center: pyrmont,
  //    zoom: 10
  //  });
  //nearbySearch(pyrmont);

} //検索窓で検索し、中央位置を設定する→半径1500m内の本屋さんを検索


function search() {
  var geocoder = new google.maps.Geocoder();
  document.getElementById('search').addEventListener('click', function () {
    geocoder.geocode({
      address: document.getElementById('keyword').value
    }, function (resultsGeo, statusGeo) {
      if (statusGeo == google.maps.GeocoderStatus.OK) {
        //  console.log(results[0].geometry);
        //  console.log(results.length);
        //var bounds = new google.maps.LatLngBounds();
        //console.log(resultsGeo);
        var lat = resultsGeo[0].geometry.location.lat();
        var lng = resultsGeo[0].geometry.location.lng(); //var pyrmont = new google.maps.LatLng(lat,lng);

        var pyrmont = resultsGeo[0].geometry.location; //var address = results[0].formatted_address;
        //console.log(pyrmont);
        //console.log(address);
        //  bounds.extend(pyrmont);
        // 位置座標のインスタンスを作成する

        map = new google.maps.Map(document.getElementById('map'), {
          center: pyrmont,
          zoom: 15
        });
        nearbySearch(pyrmont);
        createMarker();
      } else if (statusGeo == google.maps.GeocoderStatus.ZERO_RESULTS) {
        alert("見つかりません");
      } else {
        console.log(statusGeo);
        alert("エラー発生");
      }
    });
  });
}

;

function createMarker(latlng, icn, placename) {
  // マーカー作成　　https://developers.google.com/maps/documentation/javascript/examples/marker-simple　参照
  var marker = new google.maps.Marker({
    position: latlng,
    map: map
  }); //markerクリック時に場所の名前と緯度,経度を表示　2020.05.16
  //吹き出しに緯度経度を表示
  //var placename = place.name;
  //console.log(placename);
  //var latlngstring = latlng.toString();
  //console.log(latdata);
  //var contentString = placename+'<br/>'+ latlngstring;

  var infowindow = new google.maps.InfoWindow({
    //content: contentString
    content: placename
  });
  marker.addListener('click', function () {
    //マーカーをクリックした際に、既に吹き出し表示されている場合はクローズ 2020.05.19
    if (currentInfoWindow) {
      currentInfoWindow.close();
    }

    map.setCenter(latlng); //console.log(latlng);

    infowindow.open(map, marker);
    currentInfoWindow = infowindow;
    var latlngstring = latlng.toString(); //console.log(latlngstring);

    document.getElementById('place').value = placename;
    document.getElementById('lat').value = parseFloat(latlngstring.substring(1, latlngstring.indexOf(",")));
    document.getElementById('lng').value = parseFloat(latlngstring.substring(latlngstring.indexOf(",") + 2, latlngstring.indexOf(")"))); //console.log(latlngstring);

    clickAddress(latlng);
  });
} //クリックした時に住所情報を取得 2020.05.20


function clickAddress(latlng) {
  //住所を出力
  var geocoder = new google.maps.Geocoder();
  geocoder.geocode({
    location: latlng
  }, function (res, sta) {
    if (sta == google.maps.GeocoderStatus.OK) {
      //console.log(res[0]);
      var address = res[0].address_components; //都道府県名

      var pref = address[address.length - 3].long_name;
      document.getElementById('pref').value = pref; // document.getElementById('lat').value=latlng.lat;
      // document.getElementById('lng').value=latlng.lng;
      //console.log(res[0]);

      regionJudge(pref);
      var addressCity = res[0].formatted_address; //住所

      addressCity = addressCity.substring(addressCity.indexOf(pref));
      document.getElementById('address').value = addressCity; //var addressCity = res[0].vicinity;
      //console.log(addressCity);
      //  var addressCity=[];
      //  for(var i = address.length -3 ;i>=0;i--){
      //    if(i==address.length-3){
      //  console.log(address[i].long_name);
      //  }else{
      //    addressCity.push(address[i].long_name);
      //  //}
      // }
      //.formatted_address;
    } //console.log(address);

  });
}

function regionJudge(pref) {
  var region = document.getElementById("region");

  if (pref == "北海道" || pref == "青森県" || pref == "岩手県" || pref == "秋田県" || pref == "山形県" || pref == "福島県") {
    region.value = "北海道・東北";
  } else if (pref == "茨城県" || pref == "栃木県" || pref == "群馬県" || pref == "埼玉県" || pref == "千葉県" || pref == "東京都" || pref == "神奈川県") {
    region.value = "関東";
  } else if (pref == "新潟県" || pref == "富山県" || pref == "石川県" || pref == "福井県" || pref == "山梨県" || pref == "長野県" || pref == "岐阜県" || pref == "静岡県" || pref == "愛知県") {
    region.value = "中部";
  } else if (pref == "三重県" || pref == "滋賀県" || pref == "京都府" || pref == "大阪府" || pref == "兵庫県" || pref == "奈良県" || pref == "和歌山県") {
    region.value = "近畿";
  } else if (pref == "鳥取県" || pref == "島根県" || pref == "岡山県" || pref == "広島県" || pref == "山口県" || pref == "徳島県" || pref == "香川県" || pref == "愛媛県" || pref == "高知県") {
    region.value = "中国・四国";
  } else {
    region.value = "九州・沖縄";
  }
}

function inputValueClear() {
  if (document.getElementById("keyword").value !== '' || document.getElementById("keyword").value !== null) {
    document.getElementById("keyword").value = '';
  }

  if (document.getElementById("place").value !== '' || document.getElementById("place").value !== null) {
    document.getElementById("place").value = '';
  }

  if (document.getElementById("pref").value !== '' || document.getElementById("pref").value !== null) {
    document.getElementById("pref").value = '';
  }

  if (document.getElementById("region").value !== '' || document.getElementById("region").value !== null) {
    document.getElementById("region").value = '';
  }

  if (document.getElementById("address").value !== '' || document.getElementById("address").value !== null) {
    document.getElementById("address").value = '';
  }

  if (document.getElementById("lat").value !== '' || document.getElementById("lat").value !== null) {
    document.getElementById("lat").value = '';
  }

  if (document.getElementById("lng").value !== '' || document.getElementById("lng").value !== null) {
    document.getElementById("lng").value = '';
  }
}

function nearbySearch(pyrmont) {
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
        var place = results[i]; //console.log(place);

        latlng = place.geometry.location;
        icn = place.icon;
        placename = place.name;
        createMarker(latlng, icn, placename);
      }
    }
  }
}

/***/ }),

/***/ 2:
/*!***************************************************!*\
  !*** multi ./resources/js/js-googlemap.search.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/ec2-user/environment/bookstore/resources/js/js-googlemap.search.js */"./resources/js/js-googlemap.search.js");


/***/ })

/******/ });