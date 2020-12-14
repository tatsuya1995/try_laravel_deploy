@extends('layouts.owner.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">ドライバー：{{$driverInfo->nameDriver}}さんとのトークルーム</div>
                    <div class="card-body">
                        <div class ="row">
                            <div class="col-md-6">
                                <form action="{{route('owner.contract',['idDriver'=> $driverInfo->id])}}" method="get">
                                <ul class="marker">
                                    <li><img src="{{$ownerInfo->imgCar}}" class="iconImg"  alt="アイコン画像">
                                    <li>氏名:{{$ownerInfo->nameOwner}}
                                    <li>契約を結ぶ（確認画面へ移動）<input type="image" src="{{asset('assets/image/arrow2.png')}}" id="arrow2"  alt="矢印画像">
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
                        <form action="" method="post">
                        @csrf
                            <input type="hidden" name="idDriver" value="{{$driverInfo->id}}">
                            <input name='idOwner' type="hidden" value="{{$ownerInfo->id}}">
                            <input type="hidden" name="login" value="{{Auth::id()}}">
                            <textarea name="comment" cols="40" rows="3" placeholder="こちらにメッセージを入力"></textarea>
                            <input type="submit" value="送信"> 
                        </form>
                    </div>
                    {{--  チャットルーム  --}}
                    <div id="room">
                        @foreach($posts as $post)
                            {{--   送信したメッセージ  --}}
                            @if($post->idDriver == Auth::id())
                                <div class="driver" style="text-align: right">
                                    <p>{{$post->comment}}</p>
                                </div>
                            @endif
                            {{--   受信したメッセージ  --}}
                            @if($post->idOwner == Auth::id())
                                <div class="owner" style="text-align: left">
                                    <p>{{$post->comment}}</p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                <input type="hidden" name="idDriver" value="{{$driverInfo->id}}">
                <input type="hidden" name="idOwner" value="{{$ownerInfo->id}}">
                <input type="hidden" name="login" value="{{Auth::id()}}">

                <script src="/js/app.js"></script>
    <!-- <script src=“https://js.pusher.com/3.2/pusher.min.js“></script>
    <script src=“https://cdnjs.cloudflare.com/ajax/libs/push.js/0.0.11/push.min.js”></script> -->
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

            if(data.idDriver === login){
                appendText = '<div class="idDriver" style="text-align:right"><p>' + data.comment + '</p></div> ';
            }else if(data.idOwner === login){
                appendText = '<div class="idOwner" style="text-align:left"><p>' + data.comment + '</p></div> ';
            }else{
                return false;
            }

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
        $('#submit').on('click' , function(){
            $.ajax({
            type : 'POST',
            url : '/driver/talk',
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
