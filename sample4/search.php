<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>つぶやく練習のためのフォーム</title>
  </head>
  <body>
    <div>
      <?php
      # h()関数☆レシピ221☆（安全にブラウザで値を表示したい）を読み込みます☆レシピ041☆（他のファイルを取り込んで利用したい）。
      require_once 'h.php';

      if (isset($_GET['example1'])) {
        require_once 'database_conf.php';
        require_once 'h.php';

        try {
          $db = new PDO($dsn, $dbUser, $dbPass);
          $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $sql = 'SELECT * FROM tweets WHERE body LIKE :word';
          $prepare = $db->prepare($sql);
          $prepare->bindValue(':word', '%' . $_GET['example1'] . '%', PDO::PARAM_STR);
          $prepare->execute();
          $result = $prepare->fetchAll(PDO::FETCH_ASSOC);

          echo '<p>結果</p>';
          echo '<ul>';
          foreach ($result as $tweet) {
            echo '<li>' . h($tweet['body']) . '</li>';
          }
          echo '</ul>';
        } catch (PDOException $e) {
          echo 'エラーが発生しました。内容: ' . h($e->getMessage());
        }
      }
      ?>
      <form method="get" action="search.php">
        <p>テキストボックス（autofocus属性を指定）
          <input type="text" name="example1" value="" autofocus></p>
        <p><input type="submit" value="送信する"></p>
      </form>
    </div>
  </body>
</html>
