@extends('layouts.common')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="card text-center">
        <div class="card-body">
          <h3>車を借りたい人・貸したい人　両者の思いを我々Car.マッチングが結びます。</h3>
          <img src="image/index.png" width="400" alt="Car.マッチングイメージ画像">
        </div>
      </div>
    </div>
    <div class="col-md-6 text-center">
      <div class="card">
        <div class="card-body">
          <h3>ドライバー目線</h3>
          <ul>
            <li>月に一回だけ車に乗りたいけど買うほどではない
            <li>レンタカー屋が近くにないから不便
            <li>ライフスタイルに合わせた利用がしたい
          </ul>
        </div>
        <div>
          <img src="image/arrows.png"  width="70px" alt="矢印画像">
        </div>
        <div>
          <h3>オーナー目線</h3>
          <ul>
            <li>平日しか車は使わないから、土日は車庫に入れたまま
            <li>副収入になるのであれば有難いけど登録は面倒
            <li>人に貸してドラブルが起きないか心配
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!--２列目-->
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h3 class="card-text">サービスの特徴</h3>
          <ul>
            <li>ドライバーとオーナー同士で直接交渉して貸し借り可能!</li>
            <li>貸し出す・借りる相手を確認してから判断OK！</li>
            <li>（アプリ内掲示板でのやり取りのみ）</li>
            <li>車両保険の加入は交渉成立時に弊社が実施。</li>
          </ul>
          <h3>分かりやすい料金設定！</h3>
          <ul>
            <li>料金：オーナーとの交渉価格＋車両保険料</li>
            <li>※合計金額から仲介手数料として５％承ります</li>
          </ul>
        </div>
      </div>
    </div>  
    <div class="col-md-6 text-center">
    <div class="card">
        <div class="card-body">
      <div>
        <h3>ログイン</h3>
          <p><a href="{{('driver/login')}}" ><img src="image/driverlogin.png" width="150" alt="ドライバーログインボタン"></a>
          (車両を借りたい方)<p>
          <p><a href="{{('owner/login')}}"><img src="image/ownerlogin.png" width="150" alt="オーナーログインボタン"></a>
          (車両を貸したい方)</p>
      </div>
      <div>
          <h3>新規登録</h3>
            <p><a href="{{'driver/register'}}"><img src="image/driverregist.png" width="150" alt="ドライバー登録ボタン"></a>
            (車両を借りたい方)</p>
            <p><a href="{{'owner/register'}}"><img src="image/ownerregist.png" width="150" alt="オーナー登録ボタン"></a> 
            (車両を貸したい方)</p>
      </div>
      </div>
      </div>
    </div>
  </div>
</div>
@endsection

