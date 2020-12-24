![画像](logo.png)
 
# アプリ説明
 URL:
車両を保有している人と保有していない人を結ぶSNSアプリケーション。
大手カーシェアリングサービスのように車を保有する会社からドライバーに貸し出すのでなく、
個人間で気軽に貸し出せるサービスをコンセプトとした。

①操作がシンプル（登録→検索→チャット→契約）
②LINEのような手軽さで個人間で会話可能
③契約内容のエビデンスとしてメールを自動送信
# 制作背景



# デモ
[操作説明資料 リンク] (https://docs.google.com/presentation/d/1vp0uW4S5cwLc9BGpcaWo-VbV1Sns1QpCnw0aN3KeQYs/edit?usp=sharing)
"hoge"の魅力が直感的に伝えわるデモ動画や図解を載せる

#制作背景
<a href="https://docs.google.com/presentation/d/1tZJGasBnQbUNXXe0prZ4kC7agbCEJ5aUzGzq7WhR7zA/edit?usp=sharing">リンク</a>
疑問を抱いたため、調査を行い、その問題を解決することを目的とした。

車を持たなくなってきた。なぜ普及しないのか。
なぜなぜを絵にする。
トヨタの問題解決手法を用いて普及していない理由を提議。
それを解決するようなサービスを目指した。

#画面のイメージ

どうやって撮ってるんやろか

# こだわり
 
"hoge"のセールスポイントや差別化などを説明する
 
# 使用技術
 
 バックエンド
* PHP 7.2.34
* Laravel 6.20.5

 フロントエンド
* HTML
* CSS
* javascript
* jQuery 3.2.1
* Vue.js(現在学習中のため今後組み込む)

　インフラ
* mysql 8.0.22
* AWS(EC2,S3)


　その他の使用技術
* Pusher
* git(gitHub)
* Visual Studio Code
* draw.io
* Gmail
 
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
 
# 最後に
 
興味を持っていただけましたら、自己紹介サイトも見ていただけると幸いです。
URL
 
