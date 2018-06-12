<?php
//データベース接続設定
$dbServer = '127.0.0.1';
$dbName = 'sample1';
$dsn = "mysql:host={$dbServer};dbname={$dbName};charset=utf8";
$dbUser = 'test';
$dbPass = 'pass';

//データベースへの接続
$db = new PDO($dsn, $dbUser, $dbPass);

//検索実行
$sql = 'SELECT id, name FROM members';
$prepare = $db->prepare($sql);
$prepare->execute();
$result = $prepare->fetchAll(PDO::FETCH_ASSOC);

//結果の出力
foreach ($result as $person) {//1件ずつ，$personという仮の名前で取り出す
  echo $person['id'];//idを読む
  echo ',';
  echo $person['name'];//nameを読む
  echo "<br/>";//改行
}
