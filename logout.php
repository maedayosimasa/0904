<?php
session_start();
session_destroy(); // セッションを破棄
header('Location: form_log.php'); // ログアウト後にログインページへリダイレクト
exit();
?>
