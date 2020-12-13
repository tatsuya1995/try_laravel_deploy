@extends('layouts.owner.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('登録情報') }}</div>
                    <div class="card-body">
                        <form action="{{route('owner.update',['id'=>$owner->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                        <label for="nameOwner" class="col-md-4 col-form-label text-md-right">{{ __('氏名') }}</label>
                            <div class="col-md-6">
                                <input id="nameOwner" type="text" class="form-control" name="nameOwner" value="{{$owner->nameOwner }}" required autocomplete="nameOwner" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $owner->email }}" required autocomplete="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="iconOwner" class="col-md-4 col-form-label text-md-right">{{ __('アイコン画像') }}</label>
                            <div class="col-md-6">
                                <input id="iconOwner" type="file"  name="iconOwner" value="{{ $owner->iconOwner }}" required autocomplete="iconOwner">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="imgCar" class="col-md-4 col-form-label text-md-right">{{ __('車両画像') }}</label>
                            <div class="col-md-6">
                                <input id="imgCar" type="file"  name="imgCar" value="{{ $owner->imgCar }}" required autocomplete="imgCar">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nameCar" class="col-md-4 col-form-label text-md-right">{{ __('車種名') }}</label>
                            <div class="col-md-6">
                                <input id="nameCar" type="text" class="form-control" name="nameCar" value="{{ $owner->nameCar }}" required autocomplete="nameCar">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="numPeople" class="col-md-4 col-form-label text-md-right">{{ __('最大乗車人数') }}</label>
                            <div class="col-md-6">
                                <input id="numPeople" type="number" class="form-control" name="numPeople" value="{{ $owner->numPeople }}" required autocomplete="numPeople">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                        {{ __('登録') }}
                            </div>
                        </div>
                        </form>
                    <a href="{{route('index')}}">トップページへ戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
