![画像](logo.png)
 

# 概要
[→[アプリケーション リンク](http://aws-tatsuya-infra)]<br>
車両を保有している人と保有していない人を結ぶSNSアプリケーション。
大手カーシェアリングサービスのように車両を会社からドライバーに貸し出す(BtoB)のでなく、
個人間で気軽に貸し出せるサービス(CtoC)をコンセプトとした。


# 制作背景
交通インフラの整備や若者の車離れの影響を受け、自動車の国内需要は１９９０年ごろをピークとして年々減少している。これに伴い、大手のBtoBのカーシェアリングサービスが会員数は5年で約4倍以上伸びている。対して、今後の伸びてくると予想されていたCtoCのカーシェアリングは伸び悩んでいるというギャップが生じている。この現象に疑問を持ったため、原因をトヨタの問題解決の手法を用いて考え、このギャップを解決するサービスの開発を行った。
<br>[→[制作背景詳細 リンク](https://docs.google.com/presentation/d/1tZJGasBnQbUNXXe0prZ4kC7agbCEJ5aUzGzq7WhR7zA/edit?usp=sharing)]

# デモ
<br>[→[操作説明 リンク](https://docs.google.com/presentation/d/1vp0uW4S5cwLc9BGpcaWo-VbV1Sns1QpCnw0aN3KeQYs/edit?usp=sharing)]
"hoge"の魅力が直感的に伝えわるデモ動画や図解を載せる

#ドライバーの基本操作<br>
ログイン→希望の条件で検索→該当したオーナーとチャットでの交流
![driver](driver.gif)
#オーナーの基本操作<br>
ログイン→車両を貸し出せる日程を登録→ドライバーから依頼があればチャットでの交流→オーナーとドライバーが契約条件に合意した場合、契約フォームに記入し、Car.マッチングへメール送信
![owner1](owner1.gif)
#オーナーの基本操作<br>
![onwer2](owner2.gif)
#管理者（Car.マッチング株式会社）の基本操作<br>
![onwer2](admin.png)
 
#画面のイメージ

どうやって撮ってるんやろか

# こだわり
 
"hoge"のセールスポイントや差別化などを説明する
 
1. 初期登録の簡略化
2. 操作がシンプル（登録→検索→チャット→契約）
3. LINEのような手軽さで個人間でチャットが可能(非同期通信)
4. 契約内容のエビデンスとしてメールの自動送信
5. 管理者用の契約内容閲覧機能

# 使用技術
 
* バックエンド<br>
    PHP 7.2.34 / Laravel 6.20.5

* フロントエンド<br>
    HTML / CSS / javascript / jQuery 3.2.1 / Vue.js(現在学習中のため今後組み込む)

* インフラ<br>
    mysql 8.0.22 / AWS(EC2,S3)


* その他の使用技術<br>
    Pusher / git(gitHub) / Visual Studio Code / draw.io / Gmail
 
 # AWS構成図
![画像](AWS.png)

 # DB設計
・ER図
![画像](finaltable.png)
・各種テーブル

| **テーブル名** | **定義** |
| ---- | ---- |
| owners(オーナー) | オーナーの登録情報 |
| drivers(ドライバー) | ドライバーの登録情報 |
| owner_schedules(オーナースケジュール) | ドライバーの車両貸出可能な日程 |
| chats(チャット) | 会話の内容 |
| contracts(コントラクト) | 契約確定後、契約内容を格納|

# 使い方

ーオーナ（貸したい人）ー

ーオーナ（貸りたい人）ー
DEMOの実行方法など、"hoge"の基本的な使い方を説明する
 
```bash
git clone https://github.com/hoge/~
cd examples
python demo.py
```

# 苦労したところ
##①DB設計
上記にER図を添付していますが、実際のアプリケーションとテーブル名やカラム名に相違があります。機能には影響ありませんが、テーブルの命名規則の理解が曖昧ままDB設計をしていました。開発終盤に気付きましたが、影響範囲が広すぎて修正が困難になりました。この失敗を二度と繰り返さないよう再度学習を行い、Qiitaに投稿しました。初期の設計の重要性を身に染みて学びました。[→[Qiita記事 リンク](https://qiita.com/tatsuya_1995/items/4b706fc40fe2f300bbc0)]
##②AWSでのデプロイ
web系企業ではクラウドはAWSが主流になっているという情報があったのでAWSを用いて本番環境を構築しました。初めてのVimコマンドの操作に慣れていないことや、ディレクトリの階層も頭に入っていなかったことで、configファイルや.envファイルを探したり編集するだけでかなり難航しました。３０〜40時間かけてなんとかデプロイしましたが、多く悩んだ分、仮想サーバーやIPアドレスの考え方・コマンドの操作などを身に着けることができました。


# 最後に
 
興味を持っていただけましたら、自己紹介サイトも見ていただけると幸いです。
URL
 
