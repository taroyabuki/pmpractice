# PM演習の準備運動

参考書：鈴木憲治ほか『PHP逆引きレシピ』（翔泳社, 第2版, 2013/10）各研究室にあるはず。

1. 概要の説明を聞く。
1. XAMPPをインストールする。
1. HTMLファイルをウェブサーバ経由で閲覧する。（ファイルを`c:/xampp/htdocs`に置いて，http://localhost/ファイル名 にアクセスする。）
1. sample1 （名簿の検索API。某企業の採用試験の練習問題）
1. sample2 （sample1の拡張。名簿の更新UI）
1. （オプショナル）JDKとNetBeansをインストールする。（開発にはNetBeansが便利。）
1. sample3 （sample2の拡張。研究室名簿）
1. sampleA （Twitterもどき）

## XAMPPのインストール

1. （ファイルの拡張子を表示するようにしておく。）
1. （signature無しのUTF-8で保存できるテキストエディタを用意する。）
1. Apache（ウェブサーバ）とMySQL（データベースサーバ），PHP（サーバ言語），phpMyAdmin（データベース操作ツール）を入れる。
1. XAMPP Control PanelでApacheとMySQLを起動する。（うまく行かない場合，Control PanelのNetstatでポート80を使っているプログラムを確認する。Skypeは完全に終了させる。）
1. http://localhost/ にアクセスしてApacheの動作を確認する。

HTMLファイルは簡単なものをテキストエディタで作ればよい。

## sample1を試す

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

## sample2を試す

1. （オプショナル）sample2を参考に，sample1（検索）のためのフォームを作る．

## sample3を試す

## 第2週のチェック項目

1. http://localhost/member/all2.php
1. http://localhost/member/insert.html
1. http://localhost/member/update.html
1. http://localhost/member/all3.php
1. （オプショナル）研究室名簿の項目を増やす。例：身長を追加し，追加・更新フォームをそれに対応させる。さらに，身長で絞り込むための検索フォームを作る。
1. （オプショナル）研究室名簿の更新フォームを作る。

## 別のサンプル（兼サーバ公開方法解説）をためす。

https://github.com/yabukilab/yabuki-z

## 後片付け

PM演習が終わったらXAMPPを削除する。
