<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
ini_set('display_errors', "On");

//セッション開始
session_start();

// ユーザー名とパスワードのチェック
$username = $_POST['username'];
$password = $_POST['password'];

// ユーザー名が "test" でパスワードが "pass" の場合にログイン成功とする
if ($username === 'test' && $password === 'pass') {
    $_SESSION['username'] = $username;
    header('Location: select.php'); // ログイン後のページへリダイレクト
    exit();
} else {
    echo "ユーザー名またはパスワードが間違っています。";
}
?>


</body>
</html>