@extends('layouts.common')

@section('content')
<div class="container text-center">
  <div class="row" >
    <div class="col-md-6">
      <div class="card">
      <div class="card-header">ログイン</div>
        <div class="card-body">
          <div class="select">
            <h4>車両を借りたい方</h4>
            <a href="{{('driver/login')}}" ><img src="{{asset('/assets/image/driverlogin.png')}}"  class="selectbtn"></a>
          </div>
          <div class="select">
            <h4>車両を貸したい方</h4>
            <a href="{{('owner/login')}}"><img src="{{asset('/assets/image/ownerlogin.png')}}"  class="selectbtn"></a>
          </div>       
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
      <div class="card-header">新規登録</div>
        <div class="card-body">
          <div class="select">
            <h4>車両を借りたい方</h4>
            <a href="{{'driver/register'}}"><img src="{{asset('/assets/image/driverregist.png')}}"  class="selectbtn"></a>
          </div>
          <div class="select">
            <h4>車両を貸したい方</h4>
            <a href="{{'owner/register'}}"><img src="{{asset('/assets/image/ownerregist.png')}}"  class="selectbtn"></a> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
