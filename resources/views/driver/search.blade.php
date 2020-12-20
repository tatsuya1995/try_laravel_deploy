@extends('layouts.driver.app')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">検索</div>
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
                                    <label for="departure" class="col-md-4 col-form-label text-md-right">貸出時間</label>
                                    <div class="col-md-7">
                                        <input id="departure" type="datetime-local"   class="form-control" name="departure" value="{{ old('departure') }}" required autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="revert" class="col-md-4 col-form-label text-md-right">返却時間</label>
                                    <div class="col-md-7">
                                        <input id="revert" type="datetime-local"  class="form-control" name="revert" value="{{ old('revert') }}" required >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="place" class="col-md-4 col-form-label text-md-right">貸出場所</label>
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
                                    <label for="numPeople" class="col-md-4 col-form-label text-md-right">乗車人数</label>
                                    <div class="col-md-6">
                                    <input id="numPeople" type="number" class="form-control" name="numPeople" min="1" value="{{ old('numPeople') }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="submit" class="col-md-4 col-form-label text-md-right"></label>
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
                <div class="card-header">現在登録済の日程一覧</div>
                    <div class="card-body">
                        <div id="output"> 
                            @if(isset($searches))   <!--  検索ボタンの判定  -->
                                @if($searches->isEmpty())　<!--  検索条件に合う登録があるかの判定  -->
                                    <p>現在、検索条件に合う登録がありません。</p>
                                @else　　　　　　　　　　　　　
                                    <table class="table text-center">
                                        <tr>
                                            <th>出発日</th>
                                            <th>返却日</th>
                                            <th>貸出場所</th>
                                            <th>最大乗車</th>    
                                            <th>トークへ</th>                   
                                        </tr>
                                        @foreach ($searches as $search)
                                        <tr>
                                            <td>{{$search["departure"]->format('Y/m/d H:i')}}</td>
                                            <td>{{$search->revert->format('Y/m/d H:i')}}</td>
                                            <td>{{$search->place}}</td>
                                            <td>{{$search->numPeople}}人</td>
                                            <td>
                                                <form action="{{route('driver.talk')}}" method="post">
                                                @csrf
                                                    <input type="hidden" name='idOwner'value="{{$search->idOwner}}">
                                                    <input type="image" src="{{asset('assets/image/arrow2.png')}}" id="arrow3"  alt="矢印画像">
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach 
                                    </table>
                                @endif
                            @else      <!--  検索ボタンの判定  -->
                            <p>検索後に表示されます。</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
