<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>画像をつぶやくフォーム</title>
  </head>
  <body>
    <div>
      <?php
      # h()関数☆レシピ221☆（安全にブラウザで値を表示したい）を読み込みます☆レシピ041☆（他のファイルを取り込んで利用したい）。
      require_once 'h.php';

      if (isset($_POST['example1'])) {
        require_once 'database_conf.php';
        require_once 'h.php';

        try {
          $db = new PDO($dsn, $dbUser, $dbPass);
          $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $sql = 'INSERT INTO tweets (body, mime, image) VALUES (:message, :mime, :image)';
          $prepare = $db->prepare($sql);

          $prepare->bindValue(':message', $_POST['example1'], PDO::PARAM_STR);

          //☆レシピ266 アップロードされが画像の処理☆
          //データのチェックは省略
          $type = null;
          $image = null;
          if (isset($_FILES['image'])) {
            $tmp_name = $_FILES['image']['tmp_name'];
            if ($tmp_name != '') {//ファイルがアップロードされた
              //ファイルタイプを確認する☆レシピ124☆の準備が必要
              $finfo = new finfo(FILEINFO_MIME_TYPE);
              $type = $finfo->file($tmp_name);

              //アップロードされ，一時保管されたファイルを読み出す
              $file = fopen($_FILES['image']['tmp_name'], 'rb');
              $image = fread($file, $_FILES['image']['size']);
            }
          }
          $prepare->bindValue(':mime', $type, PDO::PARAM_STR);
          $prepare->bindValue(':image', $image, PDO::PARAM_STR);

          $prepare->execute();

          $id = $db->lastInsertId();
          echo '<p>結果</p>';
          echo "<p>追加したレコードのID: " . h($id) . '</p>';
          echo "<p><a href='showallimage.php'>確認</a></p>";
        } catch (PDOException $e) {
          echo 'エラーが発生しました。内容: ' . h($e->getMessage());
        }
      }
      ?>
      <form method="post" action="tweetimage.php" enctype="multipart/form-data">
        <p>テキストボックス（autofocus属性を指定）
          <input type="text" name="example1" value="" autofocus></p>
        <p>画像：<input type="file" name="image"></p>
        <p><input type="submit" value="送信する"></p>
      </form>
    </div>
  </body>
</html>
