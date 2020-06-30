@extends('layouts.admin')

@section('title','使いかた')

@section('content')
<div class ='container'>
 <div class="row">
   
   　<div class="col-md-10">
               <h1>使いかた</h1>
      </div> 
    <div class="col-md-12">
　　　
    <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#index">本屋さんを見る</a>
    </li>
    <li class="nav-item">
     <a class="nav-link" data-toggle="tab" href="#login">新規登録・ログイン</a>
    </li>
   <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#regist">本屋さんを登録する</a>
   </li>
    <li class="nav-item">
     <a class="nav-link" data-toggle="tab" href="#comment">コメントを追加登録する</a>
    </li>
   </ul>
  <div id="myTabContent" class="tab-content">
  <div class="tab-pane fade show active" id="index">
      <br>
     <p>1.本屋さん一覧をクリック</p>
    <img src="{{asset('/img/howtouse/ichiran1.jpg')}}" class="col-md-12" alt="header">
    <p>2.「地域名」「場所名」を入力して、検索をかけると絞り込みが出来ます。<br>
        各カードのヘッダー（場所名）をクリックすると、その場所を中心としたマップが表示されます。<br>
        （マップのマーカーが全て読み込まれた後にこの動作ができます）<br>
        各カードの詳細ボタンを押すと、詳細データが見れます。</p>
     <img src="{{asset('/img/howtouse/ichiran2.jpg')}}" class="col-md-12" alt="ichiran" style="width:50%;height:50%;">
     <p>3.詳細画面では、場所の地図、場所名、地域名、都道府県名、住所が表示されます。<br>
        また、お気に入りコメントがあれば、表示がされます。</p>
     <img src="{{asset('/img/howtouse/ichiran3.jpg')}}" class="col-md-12" alt="detail" style="width:50%;height:50%;">
  </div>
  <div class="tab-pane fade" id="login">
    <br>
    <p>【新規登録】</p>
    <p>1.新規登録をクリック</p>
    <img src="{{asset('/img/howtouse/shinki1.png')}}" class="col-md-12" alt="header">
    <p>2.お名前、メールアドレス、パスワード、パスワード(確認用)を入力し、<br>
       パスワードは半角英数字８文字以上で設定してください。</p>
       <img src="{{asset('/img/howtouse/shinki2.png')}}" class="col-md-12" alt="detail" style="width:50%;height:50%;">
    <p>3.仮登録確認画面に遷移するので、内容を確認してください。<br>
       パスワードは伏字で表示されます。<br>
       「仮登録」ボタンをクリックしてください。</p>   
       <img src="{{asset('/img/howtouse/shinki3.png')}}" class="col-md-12" alt="detail" style="width:50%;height:50%;">
    <p>4.仮登録完了画面に遷移し、入力したメールアドレス宛にメールが届きます。</p>
    <img src="{{asset('/img/howtouse/shinki4.png')}}" class="col-md-12" alt="detail" style="width:50%;height:50%;">
    <p>4-1. 仮登録完了画面でメールが届かないときは<br>
    「こちら」をクリックし、「メールを再送する」画面でメールアドレスがテキストボックスに入っているのを確認。<br>
    入っていない場合は入力をお願いします。</p>
     <img src="{{asset('/img/howtouse/shinki5.png')}}" class="col-md-12" alt="detail" style="width:50%;height:50%;">
    <p>再送信ボタンをクリックすると、メールが送信されます。<br>
    「登録されていないアドレスです。」というメッセージが表示される場合は、メールアドレスをご確認ください。<br>
    「すでにメール認証済みです。ログイン画面よりログインしてください。」というメッセージが表示される場合は、認証済です。
    </p>
     <img src="{{asset('/img/howtouse/shinki6.png')}}" class="col-md-12" alt="detail" style="width:50%;height:50%;">
    <p>5.メールにあるリンクをクリックします。（リンクの有効期限は1時間です)</p>
    <img src="{{asset('/img/howtouse/shinki7.png')}}" class="col-md-12" alt="detail" style="width:50%;height:50%;">
    <p>6.本登録が完了した旨の画面が表示され、「ログイン画面に戻る」ボタンでログイン画面へ遷移します。ログインをしてください。</p>
    <img src="{{asset('/img/howtouse/shinki8.png')}}" class="col-md-12" alt="detail" style="width:50%;height:50%;">
    <p>6-1.「メールリンクの有効期限（1時間)を過ぎました。認証が必要です。」というメッセージが表示されている場合は、<br>
        「メールを再送信する」リンクをクリックしてください。上記4-1.画面からメールを再送信し、メール認証を完了してください。</p>
    <img src="{{asset('/img/howtouse/shinki9.png')}}" class="col-md-12" alt="detail" style="width:50%;height:50%;">
        
    <p>【ログイン】</p>
    <p>登録したメールアドレスとパスワードを入力してください。<br>
       もし、「メール認証が行われていません。メールをご確認ください」というメッセージが表示される場合は、認証メールを確認ください。</p>
    <img src="{{asset('/img/howtouse/login1.png')}}" class="col-md-12" alt="detail" style="width:50%;height:50%;">
    <p>【パスワードを忘れたときは】</p>
    <p>1.「パスワードをお忘れですか？」をクリックし、メールアドレスを入力し、パスワード再設定メールを送信してください。</p>
    <img src="{{asset('/img/howtouse/password1.png')}}" class="col-md-12" alt="detail" style="width:50%;height:50%;">
    <p>2.メールにあるリンクをクリックし、メールアドレス、パスワード、パスワード(確認用)を入力し、パスワードを設定してください。<br>
       パスワードは半角英数字８文字以上で設定してください。</p>
       <img src="{{asset('img/howtouse/password2.png')}}" class="col-md-12" alt="detail" style="width:50%;height:50%;">
       <img src="{{asset('/img/howtouse/password3.png')}}" class="col-md-12" alt="detail" style="width:50%;height:50%;">
    <p>3.認証完了後、ログイン後のページに遷移します。</p>
     <p>3-1.「パスワードをリセットする」ボタンを押した後、メールアドレスの下に「パスワード再設定用のトークンが不正です。」と表示される場合は、<br>
       メールの有効期限が切れています。ログインページに戻り、1.からやり直してください。</p>
       <img src="{{asset('/img/howtouse/password4.png')}}" class="col-md-12" alt="detail" style="width:50%;height:50%;"> 
       
    
  </div>
  <div class="tab-pane fade" id="regist">
    <br>
    <p>1.ログイン後、「本屋さん一覧」をクリックしてください。</p>
    <img src="{{asset('/img/howtouse/touroku1.png')}}" class="col-md-12" alt="header">
    <p>2.「新規作成」をクリックしてください。</p>
     <img src="{{asset('/img/howtouse/touroku2.png')}}" class="col-md-12" alt="detail" style="width:50%;height:50%;"> 
    
    <p>3.現在位置情報を読み取ることが許可されていれば、現在地周辺の地図が、されていない場合は東京駅周辺の地図が表示されます。</p>
    <img src="{{asset('/img/howtouse/touroku3.png')}}" class="col-md-12" alt="detail" style="width:50%;height:50%;">
    <p>4.地図の中心から1500m以内で、GoogleMapsAPIで「book_store」で登録されている場所について、マーカー表示されます。</p>
    <p>5.マーカークリックすると、その場所の名前が吹き出しで表示され、「場所名」「地域名」「都道府県名」「住所」が自動的に入力されます。</p>
    <p>6.検索窓では、地名・駅名を入力し、「検索」ボタンをクリックすると、その場所中心の地図が表示されます。<br>
    （複数ある場合やチェーンの書店名だけを入力された場合は、うまく行かない場合があります。）</p>
    <p>7.「地図の状態を初期化」をクリックすると、3.の状態に戻ります。</p>
    <p>8.「入力内容削除」をクリックすると、検索窓、「場所名」「地域名」「都道府県名」「住所」の入力内容が消えます。</p>
    <p>9.場所名以降、画像(2MBまで)やハンドルネーム、お気に入りコメントを入力し、「登録」ボタンを押すと、データベースが登録されます。<br>
    （同一の「場所名」が既にデータベースに存在する場合はエラーになります）</p>
     <img src="{{asset('/img/howtouse/touroku4.png')}}" class="col-md-12" alt="detail" style="width:50%;height:50%;">
  </div>
  <div class="tab-pane fade" id="comment">
    <br>
    <p>1.ログイン後、「本屋さん一覧」をクリックしてください。</p>
    <img src="{{asset('/img/howtouse/touroku1.png')}}" class="col-md-12" alt="header">
    <p>2.各カードの「詳細」をクリックしてください。</p>
    <img src="{{asset('/img/howtouse/tuika1.png')}}" class="col-md-12" alt="detail" style="width:50%;height:50%;">
    <p>3.お気に入りコメントを追加できます。「ハンドルネーム」「お気に入りコメント」を入力し、登録してください。</p>
     <img src="{{asset('/img/howtouse/tuika2.png')}}" class="col-md-12" alt="detail" style="width:50%;height:50%;">
  </div>
  
</div>

   </div>
  </div>
</div>
@endsection