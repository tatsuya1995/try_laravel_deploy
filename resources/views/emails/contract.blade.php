<div>
<p>※契約内容の最終ご確認をお願いいたします。<br>
内容に誤りが無い場合、ご返信いただく必要はございません。</p>

</div>

<div>
<p>ーーーー契約内容ーーーーー</p>
<p>◆ドライバー名<br>
　　{{$driverInfo->nameDriver}}　様</p>
<p>◆オーナー名<br>
　　{{$ownerInfo->nameOwner}}　様</p>

<p>◆使用開始時間<br>
　　{{$request->dateDeparture}}　{{$request->timeDeparture}}</p>
<p>◆使用終了時間<br>
　　{{$request->dateRevert}}　{{$request->timeRevert}}</p>
<p>◆車両情報<br>
　　ナンバープレート：{{$request->carNumber}}</p>

<p>◆使用料金<br>
    小計　：{{$request->subTotal}}円</br>
    保険料：500 円 </br>
    手数料：{{round((($request->subTotal)+500)*0.1)}} 円</br>
    総計　：{{round((($request->subTotal)+500)*1.1)}} 円(小数点以下切り上げ)


<p>ーーーーーーーーーーーーーーー</p>
</div>

<div>
<p>契約内容に誤りがありましたら、弊社までご連絡ください。<p>

以上。<br>
--------------------------------<br>
Eメール：○○○@car.com<br>
ＴＥＬ：0123-435-678<br>
住所：〒1234-5678　福岡県○○市○○町1-2-3<br>
営業時間:09:00〜22:00</p>
</div>