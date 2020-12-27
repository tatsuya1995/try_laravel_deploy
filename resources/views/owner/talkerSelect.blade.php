@extends('layouts.owner.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">トークルームの選択</div>
                    <div class="card-body"> 
                        @isset($posts)
                            @if ($posts->isEmpty())
                                <p>現在、ドライバーからの貸出依頼はありません。</br>
                                貸出日の登録を増やすと、依頼される可能性が高くなります。</p>
                            @else
                                @foreach ($posts as $post)
                                <form action="{{route('owner.talk',['idDriver'=> $post->idDriver])}}" method="get">
                                @csrf
                                    <div class="col-md-12">
                                        <div class="card" id="cardTalk">
                                            <p><img src="{{$post->iconDriver}}" class="iconImg" alt="アイコン画像">　{{$post->nameDriver}}さん　最終投稿：{{$post->created_at->format('Y/m/d H:i')}}</p>
                                            <p>{{$post->comment}}
                                                <input type="image" src="{{asset('assets/image/arrow2.png')}}" id="arrow2"  alt="矢印画像">
                                            </form> </p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

