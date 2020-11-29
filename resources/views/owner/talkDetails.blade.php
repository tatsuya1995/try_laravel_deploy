@extends('layouts.owner.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">オーナーのトークルーム</div>
                    <div class="card-body"> 
                        <form action="{{route('owner.post',['idDriver' => $idDriver])}}" method="post">
                            @csrf
                            <input name="idDriver" type="hidden" value={{$idDriver}}>
                            <textarea name="comment" cols="40" rows="3" placeholder="こちらにメッセージを入力"></textarea>
                            <input type="submit" value="送信">
                        </form>
                        @isset($posts)
                            @foreach ($posts as $post)
                                <div class="col-md-10">
                                    <div class="card">
                                        <p>アイコン画像、{{$post->nameDriver}}さん　{{$post->created_at}}</p>
                                        <p>{{$post->comment}}</p>
                                        <!-- <form action="{{route('driver.deletePost',['id'=> $post->id])}}" method="post">
                                        @csrf
                                            <input name='idOwner' type="hidden" value="">
                                            <input class="btn btn-danger"  type="submit" value="削除">
                                        </form> -->
                                    </div>
                                </div>
                            @endforeach
                        @endisset
                        <a href="{{route('owner.talk')}}">戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

