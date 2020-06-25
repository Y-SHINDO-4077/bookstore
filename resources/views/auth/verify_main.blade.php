@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">本登録</div>

                <div class="card-body">
                　　　 @if(isset($warning))
                　　　 <div class="alert alert-success" role="alert">
                            {{$warning}}
                        </div>
                　　　 @else
                        <div class="alert alert-success" role="alert">
                            本登録が完了しました。
                        </div>
                      @endif
                </div>
            </div>
            <div class="col-md-4 pull-right">
                   @if(isset($warning))
                    <a href="{{route('auth.resend')}}">メールを再送信する</a>
                    @else
                    <a href="/login">ログイン画面へ戻る</a>
                    @endif
                </div>
        </div>
    </div>
</div>
@endsection
