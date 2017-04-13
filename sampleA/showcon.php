<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>「こん」を含むつぶやき</title>
  </head>
  <body>
    <div>
      <?php
      # データベース設定☆レシピ260☆（データベースに接続したい）を読み込みます☆レシピ041☆（他のファイルを取り込んで利用したい）。
      require_once 'database_conf.php';
      require_once 'h.php';

      try {
        # MySQLデータベースに接続します☆レシピ260☆（データベースに接続したい）。
        $db = new PDO($dsn, $dbUser, $dbPass);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        #「こん」を含むつぶやきだけをデータベースから取得する。
        $sql = 'SELECT * FROM tweets WHERE body LIKE :word';
        $prepare = $db->prepare($sql);
        $prepare->bindValue(':word', '%こん%', PDO::PARAM_STR);
        $prepare->execute();
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);

        #結果のすべてを表示する。
        echo '<ul>';
        foreach ($result as $tweet) {
          echo '<li>' . h($tweet['body']) . '</li>';
        }
        echo '</ul>';
      } catch (PDOException $e) {
        # エラーが発生した場合、PDOException例外がスローされるのでキャッチします。
        echo 'エラーが発生しました。内容: ' . h($e->getMessage());
      }
      ?>
    </div>
  </body>
</html>
