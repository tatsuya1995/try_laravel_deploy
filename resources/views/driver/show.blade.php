@extends('layouts.driver.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('登録情報編集') }}</div>
                    <div class="card-body">
                        <table class="table">
                            <tr><th>氏名</th><td>{{$driver->nameDriver}}</td></tr>
                            <tr><th>メールアドレス</th><td>{{$driver->email}}</td></tr>
                            <tr><th>ドライバーアイコン画像</th><td><img src="{{asset('storage/'.$driver->iconDriver)}}" width="150px" alt="アイコン画像"></td></tr>
                            <tr><th></th><td>
                                <form action="{{route('driver.edit',['id'=>$driver->id])}}" method="get">
                                @csrf
                                    <button type="submit" class="btn btn-primary">
                                    {{ __('編集する') }}
                                </form></td>
                            </tr>
                        </table>
                        <a href="{{route('index')}}">トップページへ戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
