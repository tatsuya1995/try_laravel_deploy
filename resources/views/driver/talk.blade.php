@extends('layouts.driver.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"　id="card-header-talk" >
                    トーク：<img src="{{$ownerInfo->iconOwner}}" class="iconImgContract" alt="アイコン画像"> {{$ownerInfo->nameOwner}} さん
                </div>
                <div class="card-body">
                    <div class ="row text-center  d-flex align-items-center">
                        <div class="col-md-6">
                            <ul class="marker">
                                <li><img src="{{$ownerInfo->imgCar}}" class="carImg" alt="車両画像">
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="marker carDetail">
                                <li>車名：{{$ownerInfo->nameCar}}
                                <li>最大乗車可能人数：{{$ownerInfo->numPeople}}人
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body"> 
                    @if ($posts->isEmpty())
                    <p>※メッセージを入力してください。</br>(例：○月○日に車両をお貸しいただけないでしょうか？5時間で3000円程度でお願いしたいです。)</p>
                    @else
                        <div id="room">
                            @foreach($posts as $key => $post)
                                @if($post->sort === 1)
                                    <div class="driver" style="text-align:left">
                                        <p><img src="{{$driverInfo->iconDriver}}" class="iconImgTalk" alt="ドライバーアイコン画像">　{{$driverInfo->nameDriver}}さん</p>
                                        <p>{{$post->comment}}</p>
                                    </div>
                                @elseif($post->sort === 0)
                                    <div class="owner" style="text-align:right">
                                        <p><img src="{{$ownerInfo->iconOwner}}" class="iconImgTalk" alt="オーナーアイコン画像">　{{$ownerInfo->nameOwner}}さん</p>
                                        <p>{{$post->comment}}</p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    <div class="row" id="fixed">
                        <form >
                            @csrf
                            <textarea id="textarea" name="comment"  placeholder="メッセージを入力"></textarea>     
                            <button type="button" class="btn btn-primary" id="send">送信</button>
                        </form>
                        <input type="hidden" name="idDriver" value="{{$driverInfo->id}}">
                            <input type="hidden" name='idOwner' value="{{$ownerInfo->id}}">
                            <input type="hidden" name="login" value="{{Auth::id()}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/app.js"></script>
<script src="https://js.pusher.com/6.0/pusher.min.js"></script>
<script>
//pusherの設定
Pusher.logToConsole = true;
var pusher = new Pusher('6dfeb35a6b59eee36ab9',{
    cluster :'ap3',
    enctypted : true
})
//チャンネルの指定
var pusherChannel = pusher.subscribe('chat');

//イベントを受信後の処理
pusherChannel.bind('chat-event',function(data) {
    //メッセージを表示
    let appendText;
    appendText = '<div class="idDriver" style="text-align:center"><p>'+'---- received　new message ---- <br>' + data.comment + '</p></div> ';
    $("#room").append(appendText);
});

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")
    }
});
//メッセージ送信
$('#send').on('click' , function(){
    $.ajax({
    type : 'POST',
    url : '/driver/post',
    data : {
        comment : $('textarea[name="comment"]').val(),
        idDriver : $('input[name="idDriver"]').val(),
        idOwner : $('input[name="idOwner"]').val(),
    }
    }).done(function(result){
        $('textarea[name="comment"]').val('');
    }).fail(function(result){
    });
});
</script>
@endsection