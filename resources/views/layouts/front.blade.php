<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
     <head>
         <meta charset ='utf-8'>
         <meta http-equiv = "X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         
         <meta name="csrf-token" content="{{ csrf_token() }}">
         
         <title>@yield('title')</title>
         
         <script src="{{ secure_asset('js/app.js') }}" defer></script>
         
         <link rel="dns-prefetch" href="https://fonts.gstatic.com">
         <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
         
         <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
         
     </head>    
     <body>
         <div id="app">
            <!--navigation bar-->
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
             <a class="navbar-brand" href="{{url('/')}}">まちの本屋さんMAPをつくろう</a>
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
             </button>

            <div class="collapse navbar-collapse" id="navbarColor01">
             <ul class="navbar-nav mr-auto">
              
              <li class="nav-item">
                  <a class="nav-link" href="/about">About</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="/howtouse">使いかた</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="/list">本屋さん一覧</a>
              </li>
             </ul>
             <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                  <a class="nav-link" href="/login">ログイン</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="/register">新規登録</a>
              </li>
             </ul>
            
            </div>
            </nav> 
             
             <main class="py-4">
                 @yield('content')
             </main>
         </div>
         <div>
          @yield('footer')
         </div>
     </body>
</html>