![画像](logo.png)
 

# 概要
車両を保有している人と保有していない人を結ぶSNSアプリケーション。
大手カーシェアリングサービスのように車両を会社からドライバーに貸し出す(BtoB)のでなく、
**個人間で気軽に貸し借りができるサービス(CtoC)をコンセプト**とした。<br>
[→[アプリケーション リンク](http://aws-tatsuya.work/)]


# 制作背景
交通インフラの整備や若者の車離れの影響を受け、自動車の国内需要は１９９０年ごろをピークとして年々減少している。これに伴い、大手のBtoBカーシェアリングサービス(タイムズ)の会員数は過去5年間で約4倍以上伸びている。対して、**今後伸びてくると予想されていたCtoCのカーシェアリング業界は伸び悩んでいる**というギャップが生じている。この現象に疑問を持ったため、原因をトヨタの問題解決の手法を用いて考え、このギャップを解決するサービスの開発を行った。
<br>[→[制作背景詳細 リンク](https://docs.google.com/presentation/d/1tZJGasBnQbUNXXe0prZ4kC7agbCEJ5aUzGzq7WhR7zA/edit?usp=sharing)]

# システム概要

このサービスのユーザーは3パターンに分けられる。</br>
&emsp; A.ドライバー (車を借りたい人）</br>
&emsp; B.オーナー （車を貸したい人）</br>
&emsp; C.管理者 (Car.マッチング株式会社:自動車保険会社）</br>

![システムフロー](systemflow.png)

# 操作説明

各ユーザーの操作方法について下記に示す。
[→[操作詳細説明 リンク](https://docs.google.com/presentation/d/1vp0uW4S5cwLc9BGpcaWo-VbV1Sns1QpCnw0aN3KeQYs/edit?usp=sharing)]

### A. ドライバーの基本操作</br>

&emsp; ①ログイン</br>
&emsp; ②希望の条件(日時や乗車人数)で検索</br>
&emsp; ③該当したオーナーとチャットでの交流</br>
&emsp; ④車両を借りることへの不安がなくなれば、契約を結んでもらえるようオーナーへ依頼</br>

![driver](driver.gif)

***

### B. オーナーの基本操作</br>

&emsp; ①ログイン</br>
&emsp; ②車両を貸し出せる日程を登録</br>
&emsp; ③ドライバーから依頼があればチャットでの交流</br>
&emsp; ④オーナーとドライバーが契約条件に合意した場合、契約フォームに入力</br>
&emsp; ⑤確認メール送信</br>

![owner1](owner1.gif)<br>
![onwer2](owner2.gif)

***

### C. 管理者(Car.マッチング株式会社:自動車保険会社）の基本操作</br>

&emsp; ①ドライバーとオーナー間で契約が結ばれた後、DBへ内容が保存されるため、それらを表示</br>
&emsp; ②この登録情報を見て自動車の保険の加入手続き・料金の支払い手続きに移行</br>
![onwer2](admin.png)
 
***

# こだわり

私はCtoCのカーシェアリング業界が伸びていない原因は主に下記の3点に起因すると考える。</br>
&emsp; ①初期登録操作のハードルが高い</br>
&emsp; ②条件に合う車両を探す作業が煩わしい</br>
&emsp; ③全く交流がない他人から車両を借りることへの不安がある</br>

これらを解決するために下記にこだわって開発した。

**A. 初期登録の簡略化**</br>
初期の登録はなるべくシンプルにしておき、ドライバーとオーナーの交渉が成立してから、更に必要な情報を入力させる。ナンバープレート情報や料金の設定など初期登録の際に煩わしさを感じるものは最後に入力させる。
    
**B. 操作がシンプル**</br>
各ページに余計な機能は付けず、直感的に分かりやすい構成を心がける。</br>
* ドライバーの操作： 初期登録 → 検索 → チャットによるオーナーとの交渉</br>
* オーナーの操作 ： 初期登録→ 貸出日程登録 → チャット → 契約詳細入力
    
**C. LINEのような手軽さで個人間でチャットが可能(非同期通信)**</br>
アプリ内のチャット機能を、スマートフォンユーザーのおよそ80％が利用しているLINEの操作に合わせることで、誰でも容易にチャット機能を使って交流できる。また、非同期通信を行うことによって画面の遷移無しで、相手のメッセージを受け取ることができる。


上記とは色合いが異なるが、その他にもユーザーと管理者を思いやった機能も追加した。    

**D. 契約内容のエビデンスとしてメールの自動送信**</br>
オーナーが契約内容を入力後、確認メールが自動でドライバー・オーナー・Carマッチング（自動車保険会社）へと送付される。これにより、ドライバーとオーナーとの間で契約した内容を失念しても、再度確認することができる。また、料金や内容の相違でトラブルが起きた際に、エビデンスとして示すこともできる。

**E. 管理者用の契約内容閲覧機能**</br>
ドライバーとオーナー間で契約が結ばれた後、DBへその内容が保存されるため、その内容を表示する機能。その内容を見て自動車の保険の加入手続き・料金の支払い手続きに移行する。<br>
[[→要件定義書 リンク](https://docs.google.com/presentation/d/1vWEF7MWPqWR6HSBz8aYNJNr0i8-kscc3NNe2huMJbcU/edit?usp=sharing)]<br>

# 使用技術
 
**バックエンド**<br>
&emsp; PHP 7.2.34 / Laravel 6.20.5

**フロントエンド**<br>
&emsp; HTML / CSS / javascript / jQuery 3.2.1 / Vue.js(現在学習中のため今後組み込む)

**インフラ**<br>
&emsp; mysql 8.0.22 / AWS(EC2,S3)

**その他の使用技術**<br>
&emsp; Pusher / git(gitHub) / Visual Studio Code / draw.io / Gmail
 
# AWS構成図
![画像](aws.png)

# DB設計
### ・ ER図
![画像](finaltable.png)
### ・ 各種テーブル

| **テーブル名** | **定義** |
| ---- | ---- |
| owners<br>(オーナー) | オーナーの登録情報 |
| drivers<br>(ドライバー) | ドライバーの登録情報 |
| owner_schedules<br>(オーナースケジュール) | ドライバーの車両貸出可能な日程 |
| chats<br>(チャット) | 会話の内容 |
| contracts<br>(コントラクト) | 契約確定後、契約内容を格納|


# 苦労したところ

### ①DB設計

ER図を添付していますが、実際のアプリケーションとテーブル名やカラム名に相違があります。テーブルの命名規則の理解が曖昧ままDB設計をしており、キャメルケースを用いた記述をしてしまいました。開発終盤に気付きましたが、影響範囲が広すぎて修正が困難になりました。この失敗を二度と繰り返さないよう再度学習を行い、Qiitaにまとめています。初期設計の重要性を身に染みて学びました。[→[Qiita記事 リンク](https://qiita.com/tatsuya_1995/items/4b706fc40fe2f300bbc0)]

### ②AWSでのデプロイ
web系企業ではクラウドはAWSが主流になっていますのでAWSを用いて本番環境を構築しました。初めてのVimコマンドの操作に慣れていないことや、ディレクトリの階層も頭に入っていなかったことで、configファイルや.envファイルを探したり編集するだけでかなり難航しました。VPCの生成から数えると30〜40時間以上かけてなんとかデプロイしました。多く悩んだ分、仮想サーバーやIPアドレスの考え方・コマンドの操作などを身に着けることができました。


# 最後に
大変お忙しい中、最後までご覧いただき誠にありがとうございました。<br>
ご興味を持っていただけましたら、下記もご覧頂けると幸いです。<br>

&emsp; [→[自己紹介サイト](https://tatsudesign.net/portfolio/main/index.html):学歴・職務経歴・webエンジニアを目指す経緯などを記載しています！]</br>
&emsp; [→[Qiita](https://qiita.com/tatsuya_1995):発信力を持ったエンジニアになるべく今後はドシドシ投稿していきます！]</br>
&emsp; [→[Twitter](https://twitter.com/string_tatsuya):日々の学習を記録・発信しています！]</br>

