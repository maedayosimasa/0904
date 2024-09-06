<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: form_log.php');
    exit();
}

ini_set('display_errors', "On");

$link = mysqli_connect("localhost", "root", "mariadb", "board");
mysqli_set_charset($link, "utf8mb4");

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($link, $_GET['id']);

    // 投稿データの取得
    $query = "SELECT * FROM message WHERE id = $id";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);

    if (!$row) {
        echo "IDが存在しません。";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $new_view_name = mysqli_real_escape_string($link, $_POST['view_name']);
        $new_message = mysqli_real_escape_string($link, $_POST['message']);
        $current_view_name = $row['view_name'];
        $current_message = $row['message'];
        $modified = date("Y-m-d H:i:s");

        // 作者名とメッセージを改行して追記
        $updated_view_name = $current_view_name . "\n" . $new_view_name;
        $updated_message = $current_message . "\n" . $new_message;

        // データベースの更新
        $query = "UPDATE message SET view_name = '$updated_view_name', message = '$updated_message', modified = '$modified' WHERE id = $id";
        if (mysqli_query($link, $query)) {
            echo "レコードが更新されました。";
            header('Location: select.php');
            exit();
        } else {
            echo "エラー: " . mysqli_error($link);
        }
    }
} else {
    echo "IDが指定されていません。";
    exit();
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>編集</title>
</head>

<body>
    <h2>編集ページ</h2>
    <form action="" method="POST">
        <label for="view_name">作者名:</label>
        <input type="text" id="view_name" name="view_name" value="" required><br>
        <label for="message">追記するメッセージ:</label>
        <textarea id="message" name="message" required></textarea><br>
        <input type="submit" value="更新">
    </form>
    <a href="select.php">掲示板に戻る</a>
</body>

</html>
