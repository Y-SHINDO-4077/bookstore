<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
     <head>
         <meta charset = 'utf-8'>
         <meta http-equiv = "X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         
         <meta name="csrf-token" content="{{ csrf_token() }}">
         
         <style>
      #map {
        height: 100%;
      }
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      .search {
        height:100%;
        text-align:center;
      }
      </style>
         
         <title>@yield('title')</title>
       
         <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
          
          
         
         <script src="{{ secure_asset('js/app.js') }}" defer></script>
         <!--<script src="{{ secure_asset('js/js-register.blade.js') }}" defer></script>-->
         
         <link rel="dns-prefetch" href="https://fonts.gstatic.com">
         <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
         
         <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
         <!--<link href="{{ secure_asset('css/admin.css') }}" rel="stylesheet">-->
         
     </head>    
     <body>
         <div id="app">
            <!--navigation bar-->
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
             <a class="navbar-brand" href="/home">NavbarHome</a>
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
             </button>

            <div class="collapse navbar-collapse" id="navbarColor01">
             <ul class="navbar-nav mr-auto">
              <!--<li class="nav-item active">
                  <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
              </li>-->
              <li class="nav-item">
                  <a class="nav-link" href="/admin/about">About</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="/admin/list">本屋さん一覧</a>
              </li>
             </ul>
             <ul class="navbar-nav ml-auto">
              {{--ログインしていたら、ログイン、新規登録リンクを表示 2020.05.17--}}
              @guest
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">ログイン</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="/register">新規登録</a>
              </li>
              {{--ログインしてたら、ユーザー名とログアウトボタンを表示 2020.05.17--}}
              @else
              <li class="nav-item">
                  <a class="nav-link">{{Auth::User()->name}}<span class="caret"></span></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">ログアウト</a>
              　  <form id="logout-form" action="{{route('logout')}}" method="POST" style="display:none;">
              　   @csrf
              　  </form>
              </li>
              @endguest
             </ul>
             <!--<form class="form-inline my-2 my-lg-0">-->
             <!--      <input class="form-control mr-sm-2" type="text" placeholder="Search">-->
             <!--      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>-->
             <!--</form>-->
            </div>
            </nav> 
            <!--navigation bar--> 
             
             <main class="py-4">
                 <div class="container py-4">
        {{-- フラッシュメッセージの表示 --}}
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        　　　</div>
 
       
                 @yield('content')
             </main>
         </div>
           @yield('footer')
     </body>
</html>