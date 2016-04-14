# PM演習の準備運動

参考書：鈴木憲治ほか『PHP逆引きレシピ』（翔泳社, 第2版, 2013/10）各研究室にあるはず。

1. 概要の説明を聞く。
1. XAMPPをインストールする。
1. HTMLファイルをウェブサーバ経由で閲覧する。（ファイルを`c:/xampp/htdocs`に置いて，http://localhost/ファイル名 にアクセスする。）
1. sample1 （名簿の検索API。某企業の採用試験の練習問題）
1. sample2 （名簿の更新UI）
1. JDKとNetBeansをインストールする。
1. sample3 （研究室名簿）
1. sample4 （Twitterもどき）
1. sample5 （書誌情報管理）

## XAMPPのインストール

1. （ファイルの拡張子を表示するようにしておく。）
1. （signature無しのUTF-8で保存できるテキストエディタを用意する。）
1. Apache（ウェブサーバ）とMySQL（データベースサーバ），PHP（サーバ言語），phpMyAdmin（データベース操作ツール）を入れる。
1. XAMPP Control PanelでApacheとMySQLを起動する。（うまく行かない場合，Control PanelのNetstatでポート80を使っているプログラムを確認する。Skypeは完全に終了させる。）
1. http://localhost/ にアクセスしてApacheの動作を確認する。

HTMLファイルは簡単なものをテキストエディタで作ればよい。

各sampleは別フォルダにある。

## 第1週のチェック項目

以下の項目がすべて終わったら退室してもよい。

1. GUIでデータを追加したときに実行されたSQL文は何か。ヒント：`INSERT`から始まる。
1. GUIでデータを確認したときに実行されたSQL文は何か。ヒント：`SELECT`から始まる。
1. http://localhost/member/all.php
1. http://localhost/member/id.php?foo=2
1. 自分で作ったURLによる`id.php`の動作確認
1. http://localhost/member/name.php?bar=%E5%A4%A7
1. 自分で作ったURLによる`name.php`の動作確認
1. （オプショナル）http://localhost/member/search.php?id=1
1. （オプショナル）http://localhost/member/search.php?name=%E5%A4%A7
1. （オプショナル）http://localhost/member/search.php?id=1&name=%E5%A4%A7
1. （オプショナル）http://localhost/member/search.php?id=3&name=%E5%A4%A7

## 後片付け

PM演習が終わったらXAMPPを削除する。
