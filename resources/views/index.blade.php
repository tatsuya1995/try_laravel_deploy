@extends('layouts.common')

@section('content')
<div class="container">
  <div class="card">
    <div class="row">
      <div class="col-md-12">
        <div class="text-center">
          <div class="card-body">
            <div id="padding">
              <h2>車を借りたい人・貸したい人</h2>
              <h2>両者の思いを<span class="under">Car.マッチング</span>が結びます。</h2>
            </div>
            <div class="frame text-center">
              <img src="{{asset('/assets/image/index.png')}}" width="80%" alt="Car.マッチングイメージ画像">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card-body">
        <h3 class="card-text">◆こんなお悩みありませんか？</h3>
          <h4 class="indent">車を借りたいけど…</h4>
          <ul class="stitch">
            <li>月に一回だけ車に乗りたいけど買うほどではない
            <li>レンタカー屋が近くにないから不便
            <li>ライフスタイルに合わせた利用がしたい
          </ul>
            <!--<div class="text-center">
              <img src="{{asset('/assets/image/arrows.png')}}"  width="70px" alt="矢印画像">
          </div> -->
          <h4 class="indent">車を上手く使えてないな…</h4>
          <ul class="stitch">
            <li>平日しか車は使わないから、土日は車庫に入れたまま
            <li>副収入になるのであれば有難いけど登録は面倒
            <li>人に貸してドラブルが起きないか心配
          </ul>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card-body">
          <h3 class="card-text">◆本サービスの特徴</h3>
          <ul class="bluetag">
            <li>ドライバーとオーナー同士で交渉して貸し借り可能!</li>
            <li>貸し出す・借りる相手を確認してから判断OK！</li>
            <li>車両保険の加入は交渉成立時に弊社が実施</li>
          </ul>
          <h3 class="card-text">◆分かりやすい料金設定！</h3>
          <ul class="bluetag">
            <li>料金：オーナーとの交渉価格＋車両保険料</li>
            <li>※合計金額から仲介手数料として弊社が５％承ります</li>
          </ul>
          <h5 class="card-text">※注意事項</h5>
          <p>アプリ内掲示板以外でのやり取りは違反行為とみなします。</p>
        </div>
      </div>  
    </div>

    <div class="row text-center">
      <div class="col-md-6">
        <div class="card-body">
        <h3>ログイン</h3>
          <p><a href="{{('driver/login')}}" ><img src="{{asset('/assets/image/driverlogin.png')}}" width="150" alt="ドライバーログインボタン"></a>
          (車両を借りたい方)<p>
          <p><a href="{{('owner/login')}}"><img src="{{asset('/assets/image/ownerlogin.png')}}" width="150" alt="オーナーログインボタン"></a>
          (車両を貸したい方)</p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card-body">
          <h3>新規登録</h3>
          <p><a href="{{'driver/register'}}"><img src="{{asset('/assets/image/driverregist.png')}}" width="150" alt="ドライバー登録ボタン"></a>
          (車両を借りたい方)</p>
          <p><a href="{{'owner/register'}}"><img src="{{asset('/assets/image/ownerregist.png')}}" width="150" alt="オーナー登録ボタン"></a> 
          (車両を貸したい方)</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

