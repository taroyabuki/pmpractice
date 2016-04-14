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
$sql = 'SELECT
  members.id AS id,
  members.name AS name,
  labos.name AS labo,
  labos.place AS place
FROM members JOIN labos ON members.lab_id=labos.id';
$prepare = $db->prepare($sql);
$prepare->execute();
$result = $prepare->fetchAll(PDO::FETCH_ASSOC);

//結果の出力
foreach ($result as $person) {
  $id = $person['id'];
  $name = $person['name'];
  $labo = $person['labo'];
  $place = $person['place'];
  echo "$id $name $labo $place<br />";//手抜き
}
