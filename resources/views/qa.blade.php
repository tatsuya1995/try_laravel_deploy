@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">{{ __('Q&A') }}</div>
                  <div class="card-body">
                  <h2 class="indent">◆事故・トラブル時について</h2>
				<div class="acdn_one">
					<div class="acdn_header">Q.利用中、交通事故を起こしてしまった場合はどうすればよいですか？<div class="i_box"><i class="one_i"></i></div></div>
					<div class="acdn_inner">
						<div class="box_one">
							<p class="txt">A.まず警察へご連絡ください。<br>
											その後、弊社へご連絡ください。弊社から保険会社及びオーナー様へご連絡いたします。</p>
						</div>
					</div>
				</div>

				<div class="acdn_one">
					<div class="acdn_header">Q.車両に異常があった場合はどうしたらいいですか？<div class="i_box"><i class="one_i"></i></div></div>
					<div class="acdn_inner">
						<div class="box_one">
							<p class="txt">A.もし、異常をみつけた場合は車には乗らず速やかに弊社までご連絡ください。</p>
						</div>
					</div>
				</div>

				<div class="acdn_one">
					<div class="acdn_header">Q.利用途中で渋滞などに巻き込まれ、予定時間に返却できない場合はどうすればよいですか？<div class="i_box"><i class="one_i"></i></div></div>
					<div class="acdn_inner">
						<div class="box_one">
							<p class="txt">A.予約が過ぎてしまう場合には、早めに返却時間の変更をお願いいたします。<br>変更手続きなく返却が遅れた場合、超過料金は通常の２倍となりますのでご注意ください。</p>
						</div>
					</div>
				</div>
				<h2 class="indent">◆予約について</h2>
				<div class="acdn_one">
					<div class="acdn_header">Q.予約のキャンセル/変更はいつまで可能ですか？<div class="i_box"><i class="one_i"></i></div></div>
					<div class="acdn_inner">
						<div class="box_one">
							<p class="txt">A.ご利用開始時間前の変更・取り消しは１日前まで可能です。<br>
								ご利用開始時間が過ぎると追加料金が発生いたします。</p>
						</div>
					</div>
				</div>
				<div class="acdn_one">
					<div class="acdn_header">Q.予約は何日前から可能ですか？<div class="i_box"><i class="one_i"></i></div></div>
					<div class="acdn_inner">
						<div class="box_one">
							<p class="txt">A.ご利用の2週間前からご予約可能となっております。</p>
						</div>
					</div>
				</div>
				<div class="acdn_one">
					<div class="acdn_header">Q.予約完了のメールが届きません。<div class="i_box"><i class="one_i"></i></div></div>
					<div class="acdn_inner">
						<div class="box_one">
							<p class="txt">A.「迷惑メール削除機能」によって、お送りするメールが受信できないことがございます。ご利用の際は、各メールサービスの「迷惑メール対応機能」メールを受信可能とするよう設定してください。<br>
								設定変更方法につきましては各携帯電話会社により異なります。お手数ですが各携帯電話会社のウェブサイトなどでご確認ください。</p>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('お問い合わせ') }}</div>
                    <div class="card-body">
                        <div class="mailform">
                        <div class="indent">
                        <p>お問い合わせは、下記フォームよりお気軽にお寄せください。</p>
                        <p>ご登録いただいた個人情報は、お問い合わせ内容の確認以外には使用いたしません。</p></br>
                        <form action="confirm.php" method="post">
                        <dl>	
                            <dt>お名前（必須）</dt>
                            <dd><input type="text" name="name" required></dd>
                        </dl>
                        <dl>
                            <dt>メールアドレス（必須）</dt>
                            <dd><input type="email" name="email" required></dd>
                        </dl>
                        <dl>
                            <dt>内容</dt>
                            <dd>
                                <select name="title" >
                                    <option value="問い合わせ（事故・トラブルについて）">事故・トラブル時について</option>
                                    <option value="問い合わせ（予約について）">予約について</option>
                                    <option value="問い合わせ（その他について）">その他</option>	
                                </select>
                            </dd>
                            <dd><textarea name="content" cols="35" rows="5" maxlength="255"
                                placeholder="内容を選択し、ご記入ください。" ></textarea></dd>
                        </dl>
                        <dd><input type="submit" value="メールを送信する"></dd>
                        </form>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
