@extends('layouts.common')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('予約フォーム') }}</div>
                    <div class="card-body">
                        <div id="input">
                            バリデーション
                            <form action="" method="post">
                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-form-label text-md-right">{{ __('貸出日') }}</label>
                                    <div class="col-md-6">
                                        <input id="departure_day" type="date" class="form-control" name="departure" value="{{ old('') }}" min="2020-10-01" max="2020-11-30" required autocomplete="" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-form-label text-md-right">{{ __('貸出時間') }}</label>
                                    <div class="col-md-6">
                                        <input id="departure_time" type="time"  step="1800" class="form-control" name="" value="{{ old('') }}" required autocomplete="" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-form-label text-md-right">{{ __('返却日') }}</label>
                                    <div class="col-md-6">
                                        <input id="revert_day" type="date" class="form-control" name="" value="{{ old('') }}"  min="2020-10-01" max="2020-11-30" required autocomplete="" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-form-label text-md-right">{{ __('返却時間') }}</label>
                                    <div class="col-md-6">
                                        <input id="revert_time" type="time" class="form-control" name="" value="{{ old('') }}" required autocomplete="" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-form-label text-md-right">{{ __('貸出場所') }}</label>
                                    <div class="col-md-6">
                                        <select name="place" class="form-control">
                                            <option value="下津熊">行橋市　下津熊</option>
                                            <option value="高瀬">行橋市　高瀬</option>
                                            <option value="大野井">行橋市　大野井</option>
                                            <option value="行事">行橋市　行事</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-form-label text-md-right"></label>
                                    <div class="col-md-6">
                                        <input type="submit" value="検索">
                                    </div>
                                <div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('テーブル') }}</div>
                    <div class="card-body">
                    検索が押されたら右画面に出力する

                    <div id="output">   <!-- 入力フォームを入れたら出力-->
                                <h3> 現在利用可能な車両はこちらです。</h3>
                                <table class="table">
                                    <tr>
                                        <th>出発日</th>
                                        <th>時間</th>
                                        <th>返却日</th>
                                        <th>時間</th> 
                                        <th>貸出場所</th>                    
                                        <th>トーク画面へGo</th>
                                    </tr>

                                    foreach($schedules as $schedule)
                                    <tr>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <!-- <td><a href="talk.php?id=様</a></td> -->
                                    </tr>
                                    endforeach

                                </table>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
