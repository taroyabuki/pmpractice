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
$sql = 'SELECT * FROM members';
$prepare = $db->prepare($sql);
$prepare->execute();
$result = $prepare->fetchAll(PDO::FETCH_ASSOC);

//結果の表
echo '<table>';
echo '<tr><th>ID</th><th>Name</th>';
foreach ($result as $person) {
  $id = $person['id'];
  $name = $person['name'];
  echo "<tr><td>$id</td><td>$name</td></tr>";//手抜き
}
echo '</table>';
