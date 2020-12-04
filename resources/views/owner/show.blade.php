@extends('layouts.owner.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('登録情報') }}</div>
                <div class="card-body">
                        <table class="table">
                            <tr><th>氏名</th><td>{{$owner->nameOwner}}</td></tr>
                            <tr><th>メールアドレス</th><td>{{$owner->email}}</td></tr>
                            <tr><th>オーナーアイコン画像</th><td><img src="{{asset('storage/'.$owner->iconOwner)}}" width="150px"></td></tr>
                            <tr><th>車両画像</th><td><img src="{{asset('storage/'.$owner->imgCar)}}" width="150px"></td></tr>
                            <tr><th>車両名</th><td>{{$owner->nameCar}}</td></tr>
                            <tr><th>最大乗車人数</th><td>{{$owner->numPeople}}人</td></tr>
                            <tr><th></th><td>
                            <form action="{{route('owner.edit',['id'=>$owner->id])}}" method="get">
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