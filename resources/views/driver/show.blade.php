@extends('layouts.driver.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('登録情報') }}</div>
                <div class="card-body">

                        <table class="table">
                            <tr><th>氏名</th><td>{{$driver->nameDriver}}</tr>
                            <tr><th>メールアドレス</th><td>{{$driver->email}}</tr>
                            <tr><th>ドライバーアイコン画像</th><td>{{$driver->iconDriver}}</tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
