@extends('layouts.owner.app')

<style>
th {
    width:20%;
}
td {
    width:80%;
}
ul {
    list-style:none;
}
</style>


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">契約確認</div>
                    <div class="card-body">
                        <button><a href="{{route('owner.talk',['idDriver'=> $driverInfo->id])}}">トークルームへ戻る</a></button>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                            @foreach($errors->all() as $message)
                                <li>{{$message}}</li>
                            @endforeach
                            </ul>
                        </div>
                        @endif
                        <table class="table table-responsive" style="overflow: scroll">
                        <form action="/owner/mailContract" method="get"> 
                        @csrf             
                        <tr class="text-nowrap"><th>ドライバー</th><td><img src="{{$driverInfo->iconDriver}}" class="iconImgContract" alt="ドライバーアイコン画像">　{{$driverInfo->nameDriver}}　様</td></tr>
                        <tr class="text-nowrap"><th>使用開始</th><td>
                                                    <dt>
                                                        <dd>
                                                            <input type="date" name="dateDeparture" value="{{old('dateDeparture')}}">
                                                            <input type="time" name="timeDeparture" value="{{old('timeDeparture')}}">
                                                        </dd>
                                                    </dt>
                                                </td></tr>
                        <tr class="text-nowrap"><th>使用終了</th><td>
                                                    <dt>
                                                        <dd>
                                                            <input type="date" name="dateRevert" value="{{(old('dateRevert'))}}">
                                                            <input type="time" name="timeRevert" value="{{old('timeRevert')}}">
                                                        </dd>
                                                    </dt>
                                                </td></tr>
                        <tr class="text-nowrap"><th>車両情報</th>
                            <td>
                                <dd>車種名：{{$ownerInfo->nameCar}}（最大{{$ownerInfo->numPeople}}人乗り）
                                <dd>ナンバープレート：<input type=text name="carNumber" value="{{old('carNumber')}}">（例.北九州123-あ-1234）
                            </td>
                        </tr>
                        <tr class="text-nowrap"><th>使用料金 </th>
                        <td>
                            <dd class="text-primary">ドライバーと合意した金額を「小計」に入力後、「計算する」ボタンを押してください。
                            <dd>小　計：<input type="text" size="5"  name="subTotal" id="subtotal" value="{{old('subTotal')}}"> 円＋保険料500円　 <b id="outputSubtotal"></b>
                            <dd>手数料：<b id="fee"></b>（小計の10%）　
                            <dd><button type="button" class="btn-primary" id="calc">計算する</button>　<b>総計：<span id="outputTotal"></span></b>
                        </td></tr>
                        <tr><th></th>
                            <td>
                                <ul>
                                    <li><input type="checkbox" name="confirm">上記の内容で問題なし
                                    <li>※メールにてドライバー確認後、最終決定となります。
                                    <li><input type="submit" value="メールを送信する">
                                </ul>
                            </td>
                        </tr>
                    <input type="hidden" name="idDriver" value="{{$driverInfo->id}}">
                        <input type="hidden" name="idOwner" value="{{$ownerInfo->id}}">
                        <input type="hidden" name="nameDriver" value="{{$driverInfo->nameDriver}}">
                        <input type="hidden" name="nameOwner" value="{{$ownerInfo->nameOwner}}">
                        <input type="hidden" name="numPeople" value="{{$ownerInfo->numPeople}}">
                        <input type="hidden" name="nameCar" value="{{$ownerInfo->nameCar}}">

                        <input type="hidden" name="fee" value="fee">
                    </form>
                    </table>
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

        // //JS→PHPへ変数を渡す
        // var $data = {"outputTotal":outputTotal,"outputSubtotal":outputSubtotal}
        // $.ajax({
        //     type: "POST",
        //     url:"ContractMail.php",
        //     data: $data,
        //     dataType: "json",
        //     scriptCharset:'utf-8',
        // }).done(function(data){
        //     alert(data);
        // });

    });

</script>