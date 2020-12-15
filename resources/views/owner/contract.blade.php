@extends('layouts.owner.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">契約確認</div>
                    <div class="card-body">
                    <table class="table">
                        <form aciton="finalcheck.php" method="post"> 

                        <tr><th>ドライバー</th><td><img src="{{$driverInfo->iconDriver}}" class="iconImgTalk" alt="ドライバーアイコン画像">　{{$driverInfo->nameDriver}}様</td>
                        <tr><th>使用開始時間</th><td>
                                                    <dt>
                                                        <dd>
                                                            <input type="date" size="2" name="month" value="">
                                                            <input type="time" size="2" name="time1" value="">
                                                        </dd>
                                                    </dt>
                                                </td>
                        <tr><th>使用終了時間</th><td>
                                                    <dt>
                                                        <dd>
                                                            <input type="date" size="2" name="month" value="">
                                                            <input type="time" size="2" name="time1" value="">
                                                        </dd>
                                                    </dt>
                                                </td>
                        <tr><th>車両情報</th><td>{{$ownerInfo->nameCar}}（最大{{$ownerInfo->numPeople}}人乗り）　　ナンバープレート：<input type=text name="carNumber">北九州い○○-1234</input> </td></tr>
                        <tr><th>使用料金 </th><td>
                            <dd class="text-primary">ドライバーと合意した金額を「小計」に入力後、<br>「計算する」ボタンを押してください。
                            <dd>小　計：<input type="text" size="5"  name="subtotal" id="subtotal"> 円＋保険料500円　 <b id="outputSubtotal"></b>
                            <dd>手数料：<b id="fee"></b>（小計の10%）　
                            <dd><button type="button" class="btn-primary" id="calc">計算する</button>　<b>総計：<span id="outputTotal"></span></b></li>
                        </td></tr>
                        <tr><th></th><td>
                            <ul>
                                <li><input type="checkbox" name="confirm">上記の内容で問題なし</li>
                        <li>※メールにてドライバー確認後、最終決定となります。</li>
                        <li><input type="submit" value="メール送信"></li>
                        </td></tr>

                        </table>

                    </div>
                    <a href="{{route('index')}}">トークルームへ戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="/js/app.js"></script>
<script>
    $(function(){
        $("#calc").click(function(){
            let subtotal, outputSubtotal ,fee, outputTotal ;
            subtotal = $("#subtotal").val();

            let error;
            if(subtotal == "" || !Number.isFinite(Number(subtotal)) ){
                error = true;
            }else{
            // 計算
            outputSubtotal = Number(subtotal) + 500 ;
            fee = Math.ceil(outputSubtotal * 0.1) ;
            outputTotal = Math.ceil(outputSubtotal + fee) ;
            //出力
            $("#outputSubtotal").text("=" + outputSubtotal + " " + "円");
            $("#fee").text(fee + " " + "円");
            $("#outputTotal").text(outputTotal + " " + "円" + "(小数点以下切り上げ)");
        }
            
            if(error) {
                alert('数値で再度入力ください');
            }
        })
    });

</script>