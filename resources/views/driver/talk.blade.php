@extends('layouts.driver.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">オーナー：{{$ownerInfo->nameOwner}}さんとのトークルーム</div>
                    <div class="card-body">
                        <div class ="row text-center">
                            <div class="col-md-6">
                                <ul class="marker">
                                    <li><img src="{{$ownerInfo->iconOwner}}" class="iconImgTalktop" alt="アイコン画像">
                                    <li>オーナー名:{{$ownerInfo->nameOwner}}
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="marker">
                                    <li><img src="{{$ownerInfo->imgCar}}" class="carImg" alt="車両画像">
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
                    <div class="row">
                        <form>
                        @csrf
                            <textarea name="comment" cols="40" rows="3" placeholder="こちらにメッセージを入力"></textarea>
                            <button type="button" id="send">送信</button>
                        </form>
                            <input type="hidden" name="idDriver" value="{{$driverInfo->id}}">
                            <input name='idOwner' type="hidden" value="{{$ownerInfo->id}}">
                            <input type="hidden" name="login" value="{{Auth::id()}}">
                    </div>
                    <div id="room">
                        @foreach($posts as $key => $post)
                            @if($post->sort === 1)
                                <div class="driver" style="text-align:left">
                                    <p>{{$post->comment}}</p>
                                </div>
                            @elseif($post->sort === 0)
                                <div class="owner" style="text-align:right">
                                    <p>{{$post->comment}}</p>
                                </div>
                            @endif
                        @endforeach
                    </div>

        <script src="/js/app.js"></script>
        <script>
        //ログを有効にする
        Pusher.logToConsole = true;

        var pusher = new Pusher('6dfeb35a6b59eee36ab9',{
            cluster :'ap3',
            enctypted : true
        })
        //チャンネルの指定
        var pusherChannel = pusher.subscribe('chat');

        //イベントを受信したら下記処理
        pusherChannel.bind('chat-event',function(data) {

            let appendText;
            let login = $('input[name="login"]').val();


            appendText = '<div class="idDriver" style="text-align:center"><p>'+'-NEW MESSAGE-<br>' + data.comment + '</p></div> ';
            // if(data.idDriver === login){
            //     appendText = '<div class="idDriver" style="text-align:right"><p>' + data.comment + '</p></div> ';
            // }else if(data.idOwner === login){
            //     appendText = '<div class="idOwner" style="text-align:left"><p>' + data.comment + '</p></div> ';
            // }else{
            //     return false;
            // }

            //メッセージを表示
            $("#room").append(appendText);

            if(data.idOwner === login){
                //ブラウザへプッシュ通知
                //一旦置いておく
            }
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
