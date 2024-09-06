<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>掲示板</title>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['username'])) {
        // セッションがない場合はログインページにリダイレクト
        header('Location: form_log.php');
        exit();
    }
    ?>

    <h2>掲示板</h2>
    <p>コメント一覧</p>
    <table class="table">
        <tr>
            <th>id</th>
            <th>作者名</th>
            <th>ひとことメッセージ</th>
            <th>投稿日時</th>
            <th>更新日時</th>
            <th>操作</th>
        </tr>

        <?php
        ini_set('display_errors', "On");

        $link = mysqli_connect("localhost", "root", "mariadb", "board");
        mysqli_set_charset($link, "utf8mb4");
        $result = mysqli_query($link, "SELECT * FROM message");

        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
            echo "<td>" . nl2br(htmlspecialchars($row["view_name"])) . "</td>";
            echo "<td>" . nl2br(htmlspecialchars($row["message"])) . "</td>";
            echo "<td>" . htmlspecialchars($row["post_data"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["modified"]) . "</td>";
            echo "<td><a href='update.php?id=" . htmlspecialchars($row["id"]) . "'>編集</a></td>";
            echo "</tr>";
        }

        mysqli_free_result($result);
        mysqli_close($link);
        ?>
    </table>

    <a href="index.php">投稿登録フォームに移動する</a><br>
    <form action="logout.php" method="POST">
        <input type="submit" value="ログアウト">
    </form>
</body>

</html>
