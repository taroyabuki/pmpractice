# 名簿の更新UI

二つの機能を新たに実装する。

1. 追加
1. 更新

## 追加

### SQL

**（PHPを書く前に）** データを追加するSQL文を書いてみる（サンプルデータを用意する際にすでに書いているが）。（コマンドプロンプトまたはPowerShellで`c:/xampp/mysql/bin/mysql -uroot sample1`としてMySQLに接続して試す。）

```sql
insert into members (id, name) values (10, '矢吹');
```

結果は`select * from members;`で確認する。

### PHP

上の例の`10`と`矢吹`の部分は実行時に決まる。これらは（後で作る）フォームから送られてくるのだが，送られてきたデータは次のように取り出す。

```php
//送信データの取得
$id = $_POST['id'];
$name = $_POST['name'];
```

PHPから実行するSQLを，次のように記述する。後で決まる部分は「`:id`」や「`:name`」のように書いておく。

```php
$sql = 'INSERT INTO members (id, name) VALUES (:id, :name)';
$prepare = $db->prepare($sql);
```

「`:id`」と「`:name`」の部分に，先に取り出した値を埋め込む。（エラーチェックは省略している。）

```php
$prepare->bindValue(':id', $id, PDO::PARAM_INT);
$prepare->bindValue(':name', $name, PDO::PARAM_STR);
```

ほかはこれまでと同じである。全体をまとめたのが[insert.php](insert.php)である。

### フォーム

これまでとの違いは，データを送信するのにフォームを必要とすることである。（補足：http://localhost/member/name.php?id=10&name=矢吹 で動くようにすることもできるが，こういう書き方をするとGETメソッドになってしまう。データが追加・更新されるときはPOSTメソッドを使うことになっているため，こういう書き方はしない。）

[insert.html](insert.html)でフォームを作る。form要素のaction属性でデータの送信先を，method属性で送信方法を指定している。先に`$_POST['id']`や`$_POST['name']`でデータを取り出せたのは，input要素の`name="id"`や`name="name"`のおかげである。

```html
<form action="insert.php" method="post">
  <input type="text" name="id" placeholder="ID" />
  <input type="text" name="name" placeholder="氏名" />
  <input type="submit" value="追加" />
</form>
```

### 動作確認

http://localhost/member/insert.html からメンバーを登録し，登録できれば成功である。（IDの重複をチェックしていないため，すでに登録されているIDで登録しようとすると，エラーで止まる。）

## 更新

### SQL

**（PHPを書く前に）** データを追加するSQL文を書いてみる。（コマンドプロンプトまたはPowerShellで`c:/xampp/mysql/bin/mysql -uroot sample1`としてMySQLに接続して試す。）

```sql
UPDATE members SET name='山田' WHERE id=4;
```

あとは「追加」と同じ。[update.php](update.php)と[update.html](update.html)を参照。