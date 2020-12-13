@extends('layouts.owner.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">契約確認</div>
                    <div class="card-body">

                        <form aciton="finalcheck.php" method="post"> 
                        <dt>ドライバー様情報
                        <dd>様</dd>  
                        </dt>
                        <dt>使用する時間帯
                            <dd><input type="text" size="2" name="month" value="">月
                            <input type="text" size="2" name="day" value="">日</dd>
                            <dd><input type="text" size="2" name="time1" value="">時〜
                            <input type="text" size="2" name="time2" value="">時</dd>
                        </dt>
                        <dt>車両情報
                            <dd>車両名</dd>
                            <dd>人乗り車両</dd>
                        </dt>

                        <dt>使用料金 
                            <dd>小　計：<input type="text" size="5"  name="subtotal" value="">円＋保険料500円　＝ 円
                            <dd>手数料： 円 × 0.05　＝　円<input type="submit" value="計算">
                            <dd><strong>総　計：円 (小数点以下切り上げ）</strong></li>
                        </dt>
                        </dl>
                        <input type="checkbox" name="confirm">上記の内容で問題なし<br>
                        <input type="submit" value="メール送信">
                        </form>
                        ※メールにてドライバー確認後、最終決定となります。
                    </div>
                    <a href="{{route('index')}}">トークルームへ戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
