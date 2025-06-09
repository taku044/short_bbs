<?php
session_start();

session_unset();//中身を空にする
session_destroy();//セッションを破棄
header("Location: login.php");
    exit(); 

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    ログアウトしました。
    <form action="login.php"method="post">
        <button>トップ画面へ</button>
    </form>
</body>
</html>