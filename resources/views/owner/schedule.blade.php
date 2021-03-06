@extends('layouts.owner.app')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">貸し出し日程を登録</div>
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
                            <form action="/owner/schedule" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-form-label text-md-right">貸出時間</label>
                                    <div class="col-md-6">
                                        <input id="departure" type="datetime-local"  step="1800" class="form-control" name="departure" value="{{ old('departure') }}" required autocomplete="" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-form-label text-md-right">返却時間</label>
                                    <div class="col-md-6">
                                        <input id="revert" type="datetime-local"  step="1800" class="form-control" name="revert" value="{{ old('revert') }}" required autocomplete="" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-form-label text-md-right">貸出場所</label>
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
                                        <input type="submit" value="追加">
                                    </div>
                                <div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
        <button><a href="talkerSelect">ドライバーとのトークはこちらから</a></button>
        </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">登録済の日程一覧</div>
                    <div class="card-body">
                        <div id="output">   <!-- 入力フォームを入れたら出力-->
                            @if (isset($ownerSchedules))
                                @if ($ownerSchedules->isEmpty())
                                    <p>現在登録がありません。貸し出し日程を登録してください。</p>
                                @else
                                <table class="table text-center table-responsive" style="overflow: scroll">
                                    <tr>
                                        <th>出発時間</th>
                                        <th>返却時間</th>
                                        <th class="text-nowrap">貸出場所</th>
                                        <th class="text-nowrap">削除</th>                    
                                    </tr>
                                    @foreach($ownerSchedules as $ownerSchedule)
                                    <tr>
                                        <td><?php echo (date('Y/m/d H:i', strtotime($ownerSchedule->departure)))?></td>
                                        <td><?php echo (date('Y/m/d H:i', strtotime($ownerSchedule->revert)))?></td>
                                        <td class="text-nowrap">{{$ownerSchedule->place}}</td>
                                        <td class="text-nowrap">
                                            <form action="{{route('owner.delete',['id'=> $ownerSchedule->id])}}" method="post">
                                            @csrf
                                                <button type="submit" class="btn-danger">削除 </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
