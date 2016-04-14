<?php
//データベース接続設定
$dbServer = '127.0.0.1';
$dbName = 'sample1';
$dsn = "mysql:host={$dbServer};dbname={$dbName};charset=utf8";
$dbUser = 'test';
$dbPass = 'pass';

//データベースへの接続
$db = new PDO($dsn, $dbUser, $dbPass);

//送信データの取得
$id = $_POST['id'];//手抜き
$name = $_POST['name'];//手抜き

//検索実行（エラーチェックを省略している）
$sql = 'UPDATE members SET name=:name WHERE id=:id';
$prepare = $db->prepare($sql);
$prepare->bindValue(':id', $id, PDO::PARAM_INT);
$prepare->bindValue(':name', $name, PDO::PARAM_STR);
$prepare->execute();

//結果の確認
echo '<a href="all.php">全件表示</a>';
