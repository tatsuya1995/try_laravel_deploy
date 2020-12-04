@extends('layouts.driver.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('登録情報') }}</div>
                    <div class="card-body">
                        <form action="{{route('driver.update',['id'=>$driver->id])}}" method="post"  enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="nameDriver" class="col-md-4 col-form-label text-md-right">{{ __('氏名') }}</label>
                            <div class="col-md-6">
                                <input id="nameDriver" type="text" class="form-control" name="nameDriver" value="{{$driver->nameDriver}}" required autocomplete="nameDriver" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{$driver->email}}" required autocomplete="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="iconDriver" class="col-md-4 col-form-label text-md-right">{{ __('アイコン画像') }}</label>
                            <div class="col-md-6">
                                <input id="iconDriver" type="file"  name="iconDriver" value="{{$driver->iconDriver}}" required autocomplete="iconDriver">
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
