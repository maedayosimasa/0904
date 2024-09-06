<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログインページ</title>
</head>

<body>

    <h2>ログインページ</h2>
    <form action="login.php" method="POST">
        <label for="username">ユーザー名:</label>
        <input type="text" id="username" name="username"><br>
        <label for="password">パスワード:</label>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="ログイン">
    </form>

</body>

</html>
