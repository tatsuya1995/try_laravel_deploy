@extends('layouts.owner.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{$ownerInfo->nameOwner}}さんの情報 <登録情報編集ボタン></div>
                    <div class="card-body">
                        <div class ="row">
                            <div class="col-md-6">
                                <ul>
                                    <li><img src="" alt="アイコン画像">
                                    <li>氏名:{{$ownerInfo->nameOwner}}
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul>
                                    <li><img src="" alt="車両画像">
                                    <li>車名：{{$ownerInfo->nameCar}}
                                    <li>最大乗車可能人数：{{$ownerInfo->numPeople}}人
                                    <li>詳細変更
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

            <p>もし、$postsがない時の表示
            「現在、ドライバーより貸出依頼はありません。」</p>
                @isset($posts)
                    @foreach ($posts as $post)
                    <div class="col-md-10">
                        <div class="card">
                            <p>アイコン画像、{{$post->nameDriver}}さん　{{$post->created_at}}</p>
                            <p>{{$post->comment}}</p>
                            <form action="{{route('owner.talkDetails',['idDriver'=> $post->idDriver])}}" method="post">
                            @csrf
                                <input class="btn"  type="submit" value="返信">
                            </form>
                        </div>
                    </div>
                    @endforeach
                    リンクが飛ばせない

                @endisset
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

