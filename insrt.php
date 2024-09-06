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
    session_start();
   //入力neme passeword取得
    $ne = $_POST["username"];
    $ps = $_POST["password"];
    //パスワード比較
    if (empty($ne) || empty($ps)) {
    echo "名前もしくはパスワードを入力してください";
    } else if ($ne == "test" && $ps == "pass") {
        unset($_SESSION["ne"]);
        unset($_SESSION["ps"]);
    echo "ログインしました";
    } else {
        echo "名前もしくはパスワードが違います";
    }


        //ログイン状態の確認
    if(isset($_SESSION["ne"]) && $_SESSION["ne"] === true){
        echo "ログイン中です" . $_SESSION["ne"] . "さん";
    }else{
        echo "ログインが必要です。";
    }
    ?>
    <!-- <a href="select.php"> <?php echo "$scc"; ?> </a> 一覧画面に戻らない-->
</body>
</html>