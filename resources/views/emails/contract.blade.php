<div>
<p>※送信確認のため、ご質問いただいたお客様もbccにて送信しております。<br>
ご返信いただく必要はございません。</p>

<p>Car.マッチング　カスタマーサポート担当者へ<br>
　{{$request->name}}様より、下記内容に関する問い合わせがありました。</P>
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
　　小計：{{$request->subtotal}}<br>
　　手数料：{{$request->fee}}


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