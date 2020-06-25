@extends('layouts.front')

@section('content')
<!--2020.06.22作成-->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ユーザー登録確認メールの再送信</div>

                @if (session('warning'))
                <div class="alert alert-primary">
                        {{session('warning')}}
                 </div>     
                @endif
                  
                <div class="card-body">
                <form class ='form-horizonal' method="POST" action ="{{route('auth.resend_mail')}}">
                    {{csrf_field()}}
                 <div class="form-group">
                     <lavel class="col-md-4" >メールアドレス</lavel>
                    <input class="form-control" type="email" value="{{$user}}" name="email">
                 </div>   
                   
                    
              
                
                <div class="form-group">
                  <div class="col-md-3">
                     <button type="submit" class="btn btn-primary">再送信</button>
                   </div>
                </div>
                </form>
                </div>  
            </div>
        </div>
    </div>
</div>
@endsection
