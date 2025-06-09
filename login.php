<?php
session_start();

if (isset($_SESSION['login_error'])) {
    echo '<p class="error-message">' . htmlspecialchars($_SESSION['login_error']) . '</p>';
    unset($_SESSION['login_error']); // エラーメッセージを一度だけ表示
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>一言掲示板 - ログイン</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>ログイン</h1>
    <form action="check.php" method="post">
        <p>ユーザー名：<input type="text" name="name" required></p>
        <p>パスワード：<input type="password" name="password" required></p>
        <p><button type="submit" name="check" value="login">ログイン</button></p>
    </form>

</body>
</html>