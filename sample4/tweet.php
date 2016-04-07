<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>新規レコードを作成したい</title>
  </head>
  <body>
    <div>
      <?php
      # データベース設定☆レシピ260☆（データベースに接続したい）を読み込みます☆レシピ041☆（他のファイルを取り込んで利用したい）。
      require_once 'database_conf.php';
      # h()関数☆レシピ221☆（安全にブラウザで値を表示したい）を読み込みます。
      require_once 'h.php';

      try {
        # MySQLデータベースに接続します☆レシピ260☆（データベースに接続したい）。
        $db = new PDO($dsn, $dbUser, $dbPass);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        # SQL文を準備します。
        $sql = 'INSERT INTO tweets (body) VALUES (:message)';
        $prepare = $db->prepare($sql);
        # SQL文のプレースホルダに値をバインドして、クエリを実行します。
        $prepare->bindValue(':message', 'テスト', PDO::PARAM_STR);
        $prepare->execute();
        # 追加したレコードのIDを取得します。
        $id = $db->lastInsertId();
        echo "追加したレコードのID: " . h($id);
      } catch (PDOException $e) {
        # エラーが発生した場合、PDOException例外がスローされるのでキャッチします。
        echo 'エラーが発生しました。内容: ' . h($e->getMessage());
      }
      ?>
    </div>
    <a href="showall.php">確認</a>
  </body>
</html>
