@extends('layouts.driver.app')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">{{ __('検索') }}</div>
                    <div class="card-body">
                        <div id="input">
                            @if ($errors->any())
                            <div class ="alert alert-danger">
                                <ul>
                                @foreach($errors->all() as $message)
                                    <li>{{$message}}</li>
                                @endforeach
                                </ul>
                            </div>
                            @endif 

                            <form action="" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-form-label text-md-right">{{ __('貸出時間') }}</label>
                                    <div class="col-md-7">
                                        <input id="departure" type="datetime-local"  step="1800" class="form-control" name="departure" value="{{ old('departure') }}" required autocomplete="" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-form-label text-md-right">{{ __('返却時間') }}</label>
                                    <div class="col-md-7">
                                        <input id="revert" type="datetime-local"  step="1800" class="form-control" name="revert" value="{{ old('revert') }}" required autocomplete="" autofocus>
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
                                <!-- <div class="form-group row">
                                    <label for="" class="col-md-4 col-form-label text-md-right">{{ __('乗車人数') }}</label>
                                    <div class="col-md-6">
                                    <input id="numPeople" type="number" class="form-control" name="numPeople" value="{{ old('numPeople') }}" required autocomplete="numPeople">
                                    </div>
                                </div> -->
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
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">{{ __('現在登録済の日程一覧') }}</div>
                    <div class="card-body">

                    <div id="output">   <!-- 入力フォームを入れたら出力-->

                                @isset($searches)
                                    <p>{{$request->departure}}</p>

                                    <table class="table">
                                    <tr>
                                        <th>出発日</th>
                                        <th>返却日</th>
                                        <th>貸出場所</th>
                                        <th>乗車人数</th>    
                                        <th>トークへ</th>                    
                
                                    </tr>
                                        @foreach ($searches as $search)
                                        <tr>
                                            <td>{{$search->departure}}</td>
                                            <td>{{$search->revert}}</td>
                                            <td>{{$search->place}}</td>
                                            <td></td>
                                            <td>
                                                <form action="{{route('driver.talk')}}" method="post">
                                                @csrf
                                                    <input type="hidden" name='idOwner'value="{{$search->idOwner}}">
                                                    <input type="submit" value="→"></input>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach 
                                @endisset
                                </table>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
