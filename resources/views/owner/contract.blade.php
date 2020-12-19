@extends('layouts.owner.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">契約確認</div>
                    <div class="card-body">
                    <table class="table">
                    <form action="/owner/mailContract" method="get"> 
                        @csrf             
                        <tr><th class="">ドライバー</th><td class=""><img src="{{$driverInfo->iconDriver}}" class="iconImgContract" alt="ドライバーアイコン画像">　{{$driverInfo->nameDriver}}　様</td></tr>
                        <tr><th class="">使用開始時間</th><td class="">
                                                    <dt>
                                                        <dd>
                                                            <input type="date" name="dateDeparture">
                                                            <input type="time" name="timeDeparture">
                                                        </dd>
                                                    </dt>
                                                </td></tr>
                        <tr><th class="">使用終了時間</th><td class="">
                                                    <dt>
                                                        <dd>
                                                            <input type="date" name="dateRevert">
                                                            <input type="time" name="timeRevert">
                                                        </dd>
                                                    </dt>
                                                </td></tr>
                        <tr><th class="">車両情報</th>
                            <td class="">
                                <dd>車種名：{{$ownerInfo->nameCar}}（最大{{$ownerInfo->numPeople}}人乗り）
                                <dd>ナンバープレート：<input type=text name="carNumber">（例.北九州123-あ-1234）</input>
                            </td>
                        </tr>
                        <tr><th class="">使用料金 </th><td class="">
                            <dd class="text-primary">ドライバーと合意した金額を「小計」に入力後、<br>「計算する」ボタンを押してください。
                            <dd>小　計：<input type="text" size="5"  name="subtotal" id="subtotal"> 円＋保険料500円　 <b id="outputSubtotal"></b>
                            <dd>手数料：<b id="fee"></b>（小計の10%）　
                            <dd><button type="button" class="btn-primary" id="calc">計算する</button>　<b>総計：<span id="outputTotal"></span></b>
                        </td></tr>
                        <tr><th class=""></th>
                            <td class="">
                                <ul>
                                    <li><input type="checkbox" name="confirm">上記の内容で問題なし
                                    <li>※メールにてドライバー確認後、最終決定となります。
                                    <li><input type="submit" value="メールを送信する">
                                </ul>
                            </td>
                        </tr>
                    <input type="hidden" name="idDriver" value="{{$driverInfo->id}}">
                        <input type="hidden" name="idOwner" value="{{$ownerInfo->id}}">
                        <input type="hidden" name="subtotal" value="">
                        <input type="hidden" name="fee" value="fee">
                    </form>
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