@extends('layouts.owner.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('登録情報') }}</div>
                <div class="card-body">

                        <table class="table">
                            <tr><th>氏名</th><td>{{$owner->nameOwner}}</tr>
                            <tr><th>メールアドレス</th><td>{{$owner->email}}</tr>
                            <tr><th>オーナーアイコン画像</th><td>{{$owner->iconOwner}}</tr>
                            <tr><th>車両画像</th><td>{{$owner->imgCar}}</tr>
                            <tr><th>車両名</th><td>{{$owner->nameCar}}</tr>
                            <tr><th>最大乗車人数</th><td>{{$owner->numPeople}}人</tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
