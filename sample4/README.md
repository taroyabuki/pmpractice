# サンプルウェブアプリ

ウェブアプリの基本要素を確認するためのウェブアプリ。以下のようなシステムを作るためには，どのような設計が必要かを考えながら試してほしい。

括弧内の3桁の数字は，鈴木憲治ほか『PHP逆引きレシピ』（翔泳社, 第2版, 2013/10）のレシピ番号を表している。例：**(007)**はp.15の「XAMPPをインストールしたい」を指している。

この本のサンプルファイルはサンプルファイル：http://2nd.php-recipe.com/download/ からダウンロードできる。たとえば，**(189)**の`textbox.php`は`htdocs/07/01/`にある（7.1節だから）。

## 必要なもの

* ウェブサーバ：ここではApache HTTP Server（通称Apache）を使う。
* データベース管理システム：ここではMySQLを使う。
* サーバのためのプログラミング言語：ここではPHPを使う。
* 開発環境：ここではテキストエディタを使う。**(009)** NetBeansを使ってもよい。

**(007)** ApacheとMySQL，PHPは，XAMPPというパッケージでまとめてインストールする。

## hello, world.

`C:/xampp/htdocs/sample`を作る（NetBeansで，PHPアプリケーション「sample」を作ってもよい。）

**`C:/xampp/htdocs/sample/index.php`を作成し，http://localhost/sample/ にアクセスする。正しく実行されれば成功。**

## データベースの準備

1. **(245)** [http://localhost/phpmyadmin](http://localhost/phpmyadmin)にアクセスし，
1. **(246)** データベース「mydb」を作り，
1. **(247)** ユーザ名「testuser」，パスワード「pass」でアクセスできるようにする。
1. **(248)** mydbの中にテーブル「tweets」を作る。このテーブルには，「つぶやき」のidと本文（body），日時（time）を記録する。

以上の操作は，逆引きレシピの通りにやってもよいが，phpMyAdminのSQLタブで，以下のSQL文でも同様のになる。

```
-- (246)
CREATE DATABASE mydb CHARSET=utf8;

-- (247)
GRANT ALL ON mydb.* TO testuser@localhost IDENTIFIED BY 'pass';

-- (248)
USE mydb;
CREATE TABLE tweets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  body VARCHAR(140),
  time TIMESTAMP
);
```

### データベースを操作する基本的なSQL文

基本的には，以下の4つの道具（CRUDでデータベースを操作する。

**(265)** Create
```
INSERT INTO テーブル (カラム名[,...]) VALUES (値[,...])
```

**(261)** Read
```
SELECT 取り出す対象 FROM テーブル [WHERE 条件]
```

**(267)** Update
```
UPDATE テーブル SET カラム名=値[,...]
```

**(268)** Delete
```
DELETE FROM テーブル [WHERE 条件]
```

### データの準備

**(252)** サンプルデータを作成する。**(253)**，**(254)**，**(255)**も試してみるといい。

```
USE mydb;
INSERT INTO tweets (body) VALUES ('hello, world');
INSERT INTO tweets (body) VALUES ('こんにちは');
INSERT INTO tweets (body) VALUES ('こんばんは');
```

## **(260)** データベースへの接続

「データベースの準備」で作成したデータベースとユーザ，パスワードを`database_conf.php`に書いておく。`h.php`を作る。

**`connect.php`を実行し，エラーにならなければ成功。**

## **(261)** データの読み取り

本質は，`SELECT * FROM tweets`である。PHPでこれを実行する手順は以下のようになる。

1. データベースに接続する。
1. SELECT文を実行し，結果を取得する。
1. 結果を箇条書きで表示する。

サンプルの`htdocs/php-recipe/08/02/pdo_fetch_array.php`を参考に，すべてのつぶやきを表示する`showall.php`を作る。

`$result`は配列だから，レシピ81の「配列をループさせる」の方法で処理する。

`$result`の中身を知りたいときは知りたいときはレシピ82の方法を試す。

**サンプルデータがすべて表示されれば成功。**

### **(261)** データの読み取り2

「こん」を含むつぶやきだけを表示する`showcon.php`を作る。本質は，`SELECT * FROM tweets WHERE body LIKE '%こん%'`である。

**「こん」を含むつぶやきがすべて表示されれば成功。**

## **(265)**データの追加

本質は，`INSERT INTO tweets (body) VALUES ('テスト')`である。サンプルの`htdocs/php-recipe/08/02/pdo_inserty.php`を参考に，これを実行する`tweet.php`を作る。

**実行するとあたらしいつぶやきが保存される。`showall.php`でそのことを確認できたら成功。**

## **(188), (189)** フォーム

サンプルの`htdocs/php-recipe/07/01/textbox.php`を参考に，つぶやく練習をするフォーム`tweetform.php`を作る。

送信されたデータは`$_POST[名前]`という形で利用する。

**送信ボタンを押したときに，テキストボックスの内容が上に表示されれば成功。**

### フォームからのつぶやき

「データの追加」と「フォーム」を組み合わせて，つぶやくけるフォーム`tweetform2.php`を作る。

**送信ボタンを押すとつぶやきがデータベースに保存される。`showall.php`でそのことを確認できたら成功。**

### フォームからの検索

「データの読み取り2」と「フォーム」を組み合わせて，つぶやくけるフォーム`search.php`を作る。新しくデータを作るわけではないため，フォームのmethodを`post`ではなく`get`に，送信されたデータの取得も`$_POST`ではなく`$_GET`にしている（POSTのままでも動くが）。（参照：「GETとPOSTの使い分け」p.479）

### **(267)** データの更新

略

### **(268)** データの削除

略

### 特定のデータの表示

指定したIDのつぶやきを表示する。

`item.html`にフォームを作る。送信ボタンを押すと`item.php?id=1`のようなURLが生成される。

**フォームからGETすることと送信パラメータでURLを組み立ててアクセスするのは同じことである。**

http://localhost/item.php?id=1 にアクセスするとID=1のつぶやきが表示されるようにする。`item.php`を参照。

`showall.php`を修正して，番号をクリックするとそのつぶやきだけを表示するような，`showall2.php`を作る。`showall.php`と`showall2.php`を比較せよ。

## 反復練習

アプリを削除する。

1. phpMyAdminで`DROP USER testuser@localhost;`として、MySQLのユーザを削除する。
1. `htdocs/sample`を削除する。

もう一度はじめからやってみる。

## 画像のアップロード

### データベースへの画像の保存

#### テーブルの修正

画像本体をとの形式を保存できるように，テーブル仕様を変更する（設計が甘かったということもあるが，作る前に全部決めておくのも大変）。

```
ALTER TABLE tweets ADD image LONGBLOB;
ALTER TABLE tweets ADD mime VARCHAR(30);
```

#### 画像の保存実験

phpMyAdminで，既存のつぶやきを編集して画像を追加してみる。MIME Typeは以下のとおり（許可する形式はこれで全部とする）。

+ GIF: image/gif
+ JPEG: image/jpeg
+ PNG: image/pnh

#### 画像の表示実験

**(266)**の後半では画像を配信するPHPを作っている。これが正攻法だが，ここで権限のチェックなどをしなければならなくなると大変だから，手を抜いて，HTMLに画像データを直接埋め込む（こういうことをするとHTMLが重くなるから本当はよくない）。

`showall.php`を修正し，`showallimage.php`を作る。両者を比較してみること。

練習：`item.php`を画像表示に対応させてみよう。

### ファイルアップロード用のフォーム

`tweetimage.php`のform要素を参照。

### **(266)**アップロードされたファイルの処理

**(124)**の準備が必要。

`tweetform2.php`に，最低限の処理を追加する。両者を比較してみること。

### 大きなファイルを扱いたいとき

（本番環境C4SAについては調べていない。）

大きいファイルをアップロード（POST）できるように，`C:/xampp/php/php.ini`を2カ所修正し，Apacheを再起動する。

```
post_max_size=16M
```

```
upload_max_filesize=16M
```

大きいデータを送信できるように，`C:/xampp/mysql/bin/my.ini`を2カ所修正し，MySQLを再起動する。

```
innodb_log_file_size = 20M
```

```
max_allowed_packet = 16M
```

## 発展

複数ユーザのつぶやきを記録するためにはどうすればいいだろうか。データベース，PHPスクリプトのどちらも修正が必要である。
