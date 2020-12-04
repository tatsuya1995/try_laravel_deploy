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
                            <input name='idOwner' type="hidden" value="{{$ownerInfo->id}}">
                            <textarea name="comment" cols="40" rows="3" placeholder="こちらにメッセージを入力"></textarea>
                            <input type="submit" value="送信">
                        </form>
                    </div>
                @isset($posts)
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
                {{ $posts->links() }}
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

