<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>データベースに接続したい（PDO）</title>
  </head>
  <body>
    <div>
      <?php
      # データベース設定を読み込みます☆レシピ041☆（他のファイルを取り込んで利用したい）。
      require_once 'database_conf.php';
      # h()関数☆レシピ221☆（安全にブラウザで値を表示したい）を読み込みます。
      require_once 'h.php';

      try {
        # MySQLデータベースに接続します。
        $db = new PDO($dsn, $dbUser, $dbPass);
        # プリペアドステートメントのエミュレーションを無効にします。
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        # エラーが発生した場合、例外☆レシピ169☆（例外処理とは何ですか？）がスローされるようにします。
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo 'データベースに接続しました';
      } catch (PDOException $e) {
        # 接続できない場合、PDOException例外がスローされるのでキャッチします。
        echo '接続できませんでした 理由: ' . h($e->getMessage());
      }
      ?>
    </div>
  </body>
</html>
