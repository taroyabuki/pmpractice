<?php
//データベース接続設定
$dbServer = '127.0.0.1';
$dbName = 'sample1';
$dsn = "mysql:host={$dbServer};dbname={$dbName};charset=utf8";
$dbUser = 'test';
$dbPass = 'pass';

//データベースへの接続
$db = new PDO($dsn, $dbUser, $dbPass);

//クエリパラメータの取得
if (isset($_GET['foo'])) {
  $id = $_GET['foo'];
} else {
  die();//簡単のため
}

//検索実行
$sql = 'SELECT * FROM members WHERE id = :id';
$prepare = $db->prepare($sql);
$prepare->bindValue(':id', $id, PDO::PARAM_INT);//$sqlの:idの部分に$idを埋め込む
$prepare->execute();
$result = $prepare->fetchAll(PDO::FETCH_ASSOC);

//結果の出力
foreach ($result as $person) {
  echo $person['id'];
  echo ' ';
  echo $person['name'];
  echo "<br/>";
}
