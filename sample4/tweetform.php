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

      echo '<p>結果<br>';
      echo 'テキストボックス（初期値とautofocus属性を指定）： ';
      if (isset($_POST['example1'])) {
        echo h($_POST['example1']);
      }
      ?>
      <form method="post" action="tweetform.php">
        <p>テキストボックス（autofocus属性を指定）
          <input type="text" name="example1" value="" autofocus></p>
        <p><input type="submit" value="送信する"></p>
      </form>
    </div>
  </body>
</html>
