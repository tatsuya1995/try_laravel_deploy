@extends('layouts.owner.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('オーナー新規登録') }}</div>

                <div class="card-body">
                <!-- バリデーションのエラー表示 -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                    <form method="POST" action="{{ route('owner.register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="nameOwner" class="col-md-4 col-form-label text-md-right">{{ __('氏名') }}</label>
                            <div class="col-md-6">
                                <input id="nameOwner" type="text" class="form-control" name="nameOwner" value="{{ old('nameOwner') }}" required autocomplete="nameOwner" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('パスワード') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('パスワード確認') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="iconOwner" class="col-md-4 col-form-label text-md-right">{{ __('アイコン画像') }}</label>
                            <div class="col-md-6">
                                <input id="iconOwner" type="file"  name="iconOwner" value="{{ old('iconOwner') }}" required autocomplete="iconOwner">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="imgCar" class="col-md-4 col-form-label text-md-right">{{ __('車両画像') }}</label>
                            <div class="col-md-6">
                                <input id="imgCar" type="file"  name="imgCar" value="{{ old('imgCar') }}" required autocomplete="imgCar">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nameCar" class="col-md-4 col-form-label text-md-right">{{ __('車種名') }}</label>
                            <div class="col-md-6">
                                <input id="nameCar" type="text" class="form-control" name="nameCar" value="{{ old('nameCar') }}" required autocomplete="nameCar">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="numPeople" class="col-md-4 col-form-label text-md-right">{{ __('最大乗車人数') }}</label>
                            <div class="col-md-6">
                                <input id="numPeople" type="number" min="1" class="form-control" name="numPeople" value="{{ old('numPeople') }}" required autocomplete="numPeople">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('登録') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
