@extends('layouts.owner.app')

@section('content')

<style>
	#fixed {
		position:fixed;
		z-index:10;
		background-color:#f5f5f5;
		border:1px solid #CCC;
		opacity:0.9;
		display: table;
		bottom:0;
		text-align:left;
		margin-bottom:20px;
		width:60%;
		

	}
	#fixed textarea {
		margin:10px 30px;
		border-radius:20px;
		padding:8px;
		display: table-cell;
		vertical-align: middle;
		width: 70%;
	}

	@media screen and (max-width: 767px) {
	#fixed button {
    	float:right;
	  }
	}
	.card {
		z-index:1;
	}
</style>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">ドライバー：<img src="{{$driverInfo->iconDriver}}" class="iconImgContract"  alt="アイコン画像"> {{$driverInfo->nameDriver}}さんとのトークルーム</div>
                    <div class="card-body">
                        <div id="room">
                        @foreach($posts as $key => $post)
                        
                            @if($post->sort === 1)
                                <div class="driverCard" style="text-align:left">
                                <p><img src="{{$driverInfo->iconDriver}}" class="iconImgTalk" alt="ドライバーアイコン画像">、{{$driverInfo->nameDriver}}さん　○○○○○○○○○{{$post->created_at}}</p>
                                    <p>{{$post->comment}}</p>
                                </div>
                            @elseif($post->sort === 0)
                            <div class="ownerCard" style="text-align:right">
                            <p><img src="{{$ownerInfo->iconOwner}}" class="iconImgTalk" alt="オーナーアイコン画像">、{{$ownerInfo->nameOwner}}さん　○○○○○○○○○{{$post->created_at}}</p>
                                <p>{{$post->comment}}</p>
                            </div>
                            @endif
                        
                        @endforeach
                        </div>

                <div id="fixed" class="row col-md-12">
                    <form>
                        @csrf
                        <textarea name="comment" cols="70" rows="3" placeholder="メッセージを入力"></textarea>
                        <button type="button" id="send">送信</button>
                    </form>
                    <div class="text-right align-items-end">
                        <form action="{{route('owner.contract',['idDriver'=> $driverInfo->id])}}" method="get">
                            @csrf
                            <div>契約を結ぶ（確認画面へ移動）<input type="image" src="{{asset('assets/image/arrow2.png')}}" id="arrow2"  alt="矢印画像"></div>
                        </form>
                    </div>
                    <input type="hidden" name="idDriver" value="{{$driverInfo->id}}">
                    <input type="hidden" name='idOwner' value="{{$ownerInfo->id}}">
                    <input type="hidden" name="login" value="{{Auth::id()}}">
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

            // console.log(data.sort);
            // if(data.sort === 1){
                appendText = '<div class="idDriver" style="text-align:center"><p>'+'-NEW MESSAGE-<br>' + data.comment + '</p></div> ';
            // }else if(data.sort === 0){
            //     appendText = '<div class="idOwner" style="text-align:right"><p>' + data.comment + '</p></div> ';
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
            url : '/owner/post',
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
