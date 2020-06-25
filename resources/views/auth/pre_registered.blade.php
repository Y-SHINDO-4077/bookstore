@extends('layouts.front')
@section('title','仮登録完了')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">仮登録完了</div>

                <div class="card-body">
                     @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('messages.A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    
                    <p>この度は、ご登録いただき、誠にありがとうございます。</p>
                    <p>ご本人様確認のため、ご登録いただいたメールアドレスに、<br>
                    本登録のご案内のメールが届きます。</p>
                    <p>そちらに記載されているURLにアクセスし、<br>
                    アカウントの本登録を完了させてください。</p>
                     <p>もし、送信されていない場合は、<a href="{{route ('auth.resend')}}">こちら</a>をクリックしてください。</p>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
