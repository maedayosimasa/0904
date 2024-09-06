<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
  <?php
     ini_set('display_errors', "On");
    
    // コネクションを開く（データベースにログイン）
    // ホスト名、ユーザー名、パスワード、使用するデータベース名
    $link = mysqli_connect("localhost","root","mariadb","board");

    // 文字コードを設定
    mysqli_set_charset($link, "utf8mb4");

    $stmt = mysqli_prepare($link,
        "INSERT INTO message (view_name,message, post_data, modified)".
        " VALUES (?, ?,?,?);");

        // s：string型  i：int型 d：float型
        // 文字列型が５つなので、ｓを５つ並べている
    mysqli_stmt_bind_param($stmt, "ssii",
        $_POST["view_name"], $_POST["message"],$_POST["mpost_data"],$_POST["modified"],
        );

    mysqli_stmt_execute($stmt);


    // コネクションを閉じる（データベースからログアウト）
    mysqli_close($link);

    echo "投稿を追加しました";
  ?>
<br>
  <a href="select.php">コメント一覧ページに戻る</a>
</body>

</html>