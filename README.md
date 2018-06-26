# サンプル1（名簿アプリ）

## 準備

1. 参考書，鈴木憲治ほか『PHP逆引きレシピ』（翔泳社, 第2版, 2013/10）を用意する。（各研究室にあるはず。）
1. エクスプローラでファイルの拡張子を表示するようにしておく。（「表示」タブの「ファイル名拡張子」をチェック）
1. signature無しのUTF-8で保存できるテキストエディタを用意する。（例：Visual Studio Code）

## XAMPPのインストール

1. Apache（ウェブサーバ）とMySQL（データベースサーバ），PHP（サーバ言語），phpMyAdmin（データベース操作ツール）を入れる。（他は入れなくてよい。）
1. XAMPP Control PanelでApacheとMySQLを起動する。（うまく行かない場合，Control PanelのNetstatでポート80を使っているプログラムを確認する。Skypeは完全に終了させる。）
1. http://localhost/ にアクセスして，Apacheが動作していることを確認する。
1. テキストエディタで`c:/xampp/htdocs/test.html`を作り，http://localhost/test.html でアクセスできることを確認する。`test.html`の内容はなんでもよい。`c:/xampp/htdocs`がいわゆる**ドキュメントルート**であり、ここに置いたファイルがウェブサーバで公開される。

## 本番

1. [sample1](sample1) （名簿の検索API。某企業の採用試験の練習問題）
1. [sample2](sample2) （sample1の拡張。名簿の更新UI）
1. [sample3](sample3) （sample2の拡張。研究室名簿）

## [（サンプル2）Twitterもどき](https://github.com/yabukilab/yabuki-z/tree/master/htdocs)

## 後片付け

演習が終わったらXAMPPを削除する。
