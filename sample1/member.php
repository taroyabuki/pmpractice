<?php
//データベース接続設定
$dbServer = '127.0.0.1';
$dbName = 'tutorial';
$dsn = "mysql:host={$dbServer};dbname={$dbName};charset=utf8";
$dbUser = 'test';
$dbPass = 'pass';

//クエリパラメータの取得
if (isset($_GET['prefecture'])) {
  $q = $_GET['prefecture'];
} else {
  $q = '';
}

//データベースへの接続
$db = new PDO($dsn, $dbUser, $dbPass,
              array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')); // for PHP before 5.3.6.
//for PHP before 5.3.6.
//$db = new PDO($dsn, $dbUser, $dbPass,
//              array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

//検索実行
$sql = 'SELECT * FROM prefectures WHERE prefecture LIKE :word';
$prepare = $db->prepare($sql);
$prepare->bindValue(':word', $q . '%', PDO::PARAM_STR);
$prepare->execute();
$result = $prepare->fetchAll(PDO::FETCH_ASSOC);

//結果をJSON形式で出力
header("Content-Type: application/json; charset=utf-8");
echo json_encode($result, JSON_UNESCAPED_UNICODE);
