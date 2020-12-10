@extends('layouts.driver.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{$ownerInfo->nameOwner}}さんの情報</div>
                    <div class="card-body">
                        <div class ="row text-center">
                            <div class="col-md-6">
                                <ul>
                                    <li><img src="{{asset('storage/'.$ownerInfo->iconOwner)}}" width="200px" alt="アイコン画像">
                                    <li>オーナー名:{{$ownerInfo->nameOwner}}
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul>
                                    <li><img src="{{asset('storage/'.$ownerInfo->imgCar)}}" width="200px" alt="車両画像">
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
            <div class="card-header">{{$ownerInfo->nameOwner}}さんのトークルーム</div>
                <div class="card-body"> 
                    <div class="row">
                        <form action="{{route('driver.post')}}" method="post">
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
                        @if($post->idDriver == $driverInfo->id)
                            <div class="driver" style="text-align: right">
                                <p>{{$post->comment}}</p>
                            </div>
                        @endif
                        {{--   受信したメッセージ  --}}
                        @if($post->idOwner == $ownerInfo->id)
                            <div class="owner" style="text-align: left">
                                <p>{{$post->comment}}</p>
                            </div>
                        @endif
                        @endforeach
                    </div>
                <input type="hidden" name="idDriver" value="{{$driverInfo->id}}">
                <input type="hidden" name="idOwner" value="{{$ownerInfo->id}}">
                <input type="hidden" name="login" value="1">

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

                <!-- @isset($posts)
                @foreach ($posts as $post)
                <div class="col-md-10">
                    <div class="card">
                        <p>アイコン画像、{{$driverInfo->nameDriver}}さん　{{$post->created_at}}、
                        <form action="{{route('driver.deletePost',['id'=> $post->id])}}" method="post">
                        @csrf
                            <input name='idOwner' type="hidden" value="{{$ownerInfo->id}}">
                            <input class="btn btn-danger"  type="submit" value="削除">
                        </form></p>
                        <p>{{$post->comment}}</p>
                    </div>
                </div>
                @endforeach
                @endisset
                リンクが飛ばせない

                </div>
            </div>
            </div>
        </div>
    </div>
</div>

