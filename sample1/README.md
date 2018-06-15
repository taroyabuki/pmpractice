# 名簿の仕様

これは某企業の採用試験の問題を参考に作成したものである。問われたのは，次に述べるAPI仕様をもとに，後で述べる実装を行うことであった。

## API

| No | メソッド | URL              | 概要                 |
|:---|:---------|:-----------------|:---------------------|
| 1  | GET      | /member/all.php  | 全メンバを取得する   |
| 2  | GET      | /member/id.php   | idを指定する         |
| 3  | GET      | /member/name.php | 名前の一部で絞り込む |

No. 1は，/member/all.phpにアクセスしたら，全メンバが出てくるようにすればよいということである。No. 2, 3も同様。（GETはHTTPメソッドの一つだが，今はあまり気にしなくてもよい。）

補足：リクエスト，レスポンスともに，文字のエンコーディング（文字を数値で表現する方法）はUTF-8とする。（ウェブアプリではこれが一般的。）

### No. 1 GET /member/all.php

#### 概要

登録されているメンバを取得する。

#### パラメータ

なし

#### リクエスト例

http://localhost/member/all.php

#### 結果例

```
1,岩瀬
2,岩橋
3,大木
4,小山
```

#### 結果例（発展）

結果を表形式で表示する。

|ID|Name|
|:-|:-|
|1|岩瀬|
|2|岩橋|
|3|大木|
|4|小山|

### No. 2 GET /member/name.php

#### 概要

idを指定してメンバを取得する。

#### パラメータ

| パラメータ名 | 必須 | 値                              |
|:-------------|:-----|:--------------------------------|
| foo          | 必須 | 指定されたidのメンバを取得する。|

#### リクエスト例

http://localhost/member/id.php?foo=2

#### 結果例

```
2 岩橋
```

#### 課題

リクエスト例をもう一つ作っておく。

### No. 3 GET /member/name.php

#### 概要

名前の一部がマッチするメンバを取得する。

#### パラメータ

| パラメータ名 | 必須 | 値                                                           |
|:-------------|:-----|:-------------------------------------------------------------|
| bar          | 必須 | 名前での絞込み。指定された値に前方一致するメンバを取得する。 |

#### リクエスト例

http://localhost/member/name.php?bar=大

補足：文字化けの危険を避けるために，`http://localhost/member/name.php?bar=%E5%A4%A7` と書いた方がいい（このページはUTF-8だから大丈夫）。
`%E5%A4%A7`は「大」をUTF-8でパーセントエンコーディングしたもの。パーセントエンコーディングしたいときは，Googleで検索してその結果のURLをエディタにコピーするのが簡単。

#### 結果例

```
3 大木
```

#### 課題

リクエスト例をもう一つ作っておく。

## 実装のヒント

次のような順番で作る。

1. データベースを作る。
1. サンプルデータを入れる。（ここまでを一つのSQLファイルにまとめておくと，やり直しが手軽になる。）
1. **APIの各機能の主要部分をSQLで書いてみる。**
1. PHPからSQL文を実行できるようにする。

3番目が特に重要で，いきなりPHPファイルを作るのではなく，先に主要部分のSQL文を書いておいた方がいい。

## 実装

### データベース

#### データベース名

`sample1`とする。

#### 保存すべき項目

ここでは次の二つでよい。

- ID
- 氏名

#### サンプルデータ

次のような一つのテーブル（表）でよい。

|ID |氏名|
|:--|:---|
|1  |岩瀬|
|2  |岩橋|
|3  |大木|
|4  |小山|

#### 権限の設定

データベース`sample1`のすべて（*）のテーブルに関する，すべて（all）の操作権限を，test@localhost（パスワードはpass）に与えことにする。

#### テーブル設計

テーブル名は`members`，各列の仕様は次のようにする。（テーブル名には複数形を使うことが多い。）

|名前|型|その他|
|:---|:----------|:-----|
|id  |int（整数）|primary key（主キー）|
|name|varchar(50)（50文字までの文字列）||

列名には，`id`や`name`のようなわかりやすい英単語を使う。（`bango`や`namae`はよくない。）

主キーというのは，データを一意に定められる値のことである。

#### SQL

以上をSQLで書くと[sample1.sql](sample1.sql)のようになる。（データベース`sample1`がすでにある場合は最初に削除するようにしているから，このSQLを実行すれば，データベースを手軽に初期状態に戻せる。phpMyAdminでGUIで作業することもできるが，このようにSQL文を書いておいた方が，再現性が保ててよい。）

SQL文は，http://localhost/phpmyadmin/ で「SQL」をクリックし，テキストボックスに貼り付けて実行できる。しかし，この方法は面倒だから，コマンドプロンプトまたはPowerShellで`c:/xampp/mysql/bin/mysql -uroot`としてMySQLに接続し，そこに入力（または貼り付け）して実行した方がいい。

### API No. 1

#### SQL

**（PHPを書く前に）** 全メンバを取得するSQL文を書いてみる。（コマンドプロンプトまたはPowerShellで`c:/xampp/mysql/bin/mysql -uroot sample1`としてMySQLに接続して試す。）

```sql
-- データベースの利用
use sample1;

select id, name from members;
```

`id`と`name`が`members`のすべてだから，`select * from members;`としてもよい。

#### PHP

API No. 1の本質は，上のSQL文である。ウェブで表示するためには，次のようにすればよい。

1. PHPからデータベースに接続する。
1. PHPでSQL文を実行する。
1. SQL文の実行結果を処理する。

##### データベースへの接続

これはいつも同じ。

```php
//データベース接続設定
$dbServer = '127.0.0.1';
$dbName = 'sample1';
$dsn = "mysql:host={$dbServer};dbname={$dbName};charset=utf8";
$dbUser = 'test';
$dbPass = 'pass';

//データベースへの接続
$db = new PDO($dsn, $dbUser, $dbPass);
```

##### SQL文の実行

これもいつも同じ（SQL文は変わる）。

```php
$sql = 'SELECT id, name FROM members';
$prepare = $db->prepare($sql);
$prepare->execute();
$result = $prepare->fetchAll(PDO::FETCH_ASSOC);
```

##### 結果の処理

結果は複数件あるのがふつうだから，`foreach`文を使って，1件ずつ処理すればよい。

```php
foreach ($result as $person) {//1件ずつ，$personという仮の名前で取り出す
  echo $person['id'];//idを読む
  echo ',';
  echo $person['name'];//nameを読む
  echo "<br/>";//改行
}
```

#### 動作確認

以上をまとめたのが[all.php](all.php)である。このファイルを`c:/xampp/htdocs/member/`にコピー，ブラウザから http://localhost/member/all.php にアクセスし，結果が表示されれば成功である。

#### API No. 1の発展

結果を表形式で表示するためには，最後の結果の処理の部分で，table要素を使うようにすればよい。

```php
//結果の表
echo '<table>';
echo '<tr><th>ID</th><th>Name</th>';
foreach ($result as $person) {
  $id = $person['id'];
  $name = $person['name'];
  echo "<tr><td>$id</td><td>$name</td></tr>";
}
echo '</table>';
```

all.phpを上記のように修正したのが[all2.php](all2.php)である。（表であることが見てわかるように，CSSを使って枠線を描いている。）

### API No. 2

#### SQL

**（PHPを書く前に）** 名前の一部を指定してメンバを取得するSQL文を書いてみる。（コマンドプロンプトまたはPowerShellで`c:/xampp/mysql/bin/mysql -uroot sample1`としてMySQLに接続して試す。）

```sql
-- データベースの利用
use sample1;

select id, name from members where id = 2;
```

#### PHP

API No. 1との違いは，SQLの「`id = 2`」の部分が実行時に決まることである。検索するIDは http://localhost/member/id.php?foo=2 のようなリクエストの「`foo=2`」の部分に書かれている。それは次のように取り出す。

```php
//クエリパラメータの取得
$id = $_GET['foo'];
```

PHPから実行するSQLを，次のように記述する。後で決まる部分は「`:id`」のように書いておく。

```php
$sql = 'SELECT * FROM members WHERE id = :id';
$prepare = $db->prepare($sql);
```

「`:id`」の部分に，先に取り出した値を埋め込む。（`PDO::PARAM_INT`は埋め込むのが整数であることを示している。）

```php
$prepare->bindValue(':id', $id, PDO::PARAM_INT);
```

ほかはall.phpと同じである。

#### 動作確認

以上をまとめたのが[id.php](id.php)である。このファイルを`c:/xampp/htdocs/member/`にコピー，ブラウザから http://localhost/member/id.php?foo=2 にアクセスし，結果が表示されれば成功である。

### API No. 3

#### SQL

**（PHPを書く前に）** IDを指定してメンバを取得するSQL文を書いてみる（`%`は任意の文字列のこと。空文字列にもマッチする）。（コマンドプロンプトまたはPowerShellで`c:/xampp/mysql/bin/mysql -uroot sample1`としてMySQLに接続して試す。）

```sql
-- データベースの利用
use sample1;

select id, name from members where name like '%大%';
```

#### PHP

SQLの一部が実行時に決まるという点で，API No. 2とほとんど同じである。検索に使う名前の一部は http://localhost/member/name.php?bar=大 のようなリクエストの「`bar=大`」の部分に書かれている。それは次のように取り出す。

```php
//クエリパラメータの取得
$name = $_GET['bar'];
```

PHPから実行するSQLを，次のように記述する。後で決まる部分は「`:id`」のように書いておく。

```php
$sql = 'SELECT * FROM members WHERE name LIKE :name';
$prepare = $db->prepare($sql);
```

「`:name`」の部分に，先に取り出した値を埋め込む（ただし前後に`%`を付ける）。（`PDO::PARAM_STR`は埋め込むのが文字列であることを示している。）

```php
$prepare->bindValue(':name', '%'.$name.'%', PDO::PARAM_STR);
```

ほかは[id.php](id.php)と同じである。

#### 動作確認

以上をまとめたのが[name.php](name.php)である。このファイルを`c:/xampp/htdocs/member/`にコピー，ブラウザから http://localhost/member/name.php?bar=大 にアクセスし，結果が表示されれば成功である。

### 課題（余裕のある人向け）

一つのURL`search.php`ですべてを兼ねるようにする。

| パラメータ名 | 必須 | 値                                                           |
|:-------------|:-----|:-------------------------------------------------------------|
| id           |      | 指定されたidのメンバを取得する。                             |
| name         |      | 名前での絞込み。指定された値に前方一致するメンバを取得する。 |

### リクエスト例

* http://localhost/member/search.php （すべて表示）
* http://localhost/member/search.php?id=1
* http://localhost/member/search.php?name=大
* http://localhost/member/search.php?id=1&name=大 （結果無し）
* http://localhost/member/search.php?id=3&name=大

### 課題（余裕のある人向け）

HTTPステータスコードを調べ，結果が無いときに，それを表すコードを返すようにする。

## [sample2](../sample2/)に進む
