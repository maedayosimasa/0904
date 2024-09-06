<?php
//削除
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



        // データベースの削除
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
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>投稿削除ページ</h2>
    <form action="" method="POST">
        <!--作者名不要 <label for="view_name">作者名:</label>
        <input type="text" id="view_name" name="view_name" value="" required><br> -->
        <label for="message">削除するメッセージ:</label>
        <textarea id="message" name="message" required></textarea><br>
        <?php 
    echo $row['massage'];
        ?>
        <p>メッセージを削除してよろしいですか？</p><br>
        <p>良ければ削除ボタンを押して削除してください。</p><br>
        <input type="submit" value="削除">
    </form>
    <a href="select.php">掲示板に戻る</a>

    <div class="container">
        <h2>投稿削除確認</h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">削除する投稿</h5>
                <p><strong>作者名:</strong> <?php echo htmlspecialchars($row['view_name'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p><strong>メッセージ:</strong> <?php echo nl2br(htmlspecialchars($row['message'], ENT_QUOTES, 'UTF-8')); ?></p>
                <p><strong>投稿日時:</strong> <?php echo htmlspecialchars($row['created'], ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        </div>

        <form action="" method="POST">
            <input type="hidden" name="delete" value="1">
            <button type="submit" class="btn btn-danger mt-3">この投稿を削除</button>
            <a href="select.php" class="btn btn-secondary mt-3">キャンセル</a>
        </form>
    </div>

</body>
</body>
</html>