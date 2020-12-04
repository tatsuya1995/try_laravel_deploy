@extends('layouts.common')

@section('content')
<div class="container text-center">
  <div class="row" >
    <div class="col-md-6">
      <div class="card">
      <div class="card-header">{{ __('ログイン') }}</div>
        <div class="card-body">
          <h3>車両を借りたい方</h3>
          <a href="{{('driver/login')}}" ><img src="{{asset('/assets/image/driverlogin.png')}}" width="200" class="loginbtn"></a>
          <h3>車両を貸したい方</h3>
          <a href="{{('owner/login')}}"><img src="{{asset('/assets/image/ownerlogin.png')}}" width="200" class="loginbtn"></a>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
      <div class="card-header">{{ __('新規登録') }}</div>
        <div class="card-body">
          <h3>車両を借りたい方</h3>
          <a href="{{'driver/register'}}"><img src="{{asset('/assets/image/driverregist.png')}}" width="200" class="loginbtn"></a>
          <h3>車両を貸したい方</h3>
          <a href="{{'owner/register'}}"><img src="{{asset('/assets/image/ownerregist.png')}}" width="200" class="loginbtn"></a> 
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
