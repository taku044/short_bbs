<?php
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'ゲスト';
$id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
$message = isset($_SESSION['message']) ? $_SESSION['message'] : null;

if (isset($_SESSION['login_error'])) {
    echo '<p class="error-message">' . htmlspecialchars($_SESSION['login_error']) . '</p>';
    unset($_SESSION['login_error']); // エラーメッセージを一度だけ表示
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>一言掲示板 - 投稿</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>💬 一言掲示板</h1>
    <p>ようこそ <?= htmlspecialchars($username) ?> さん</p>

    <?php if ($message): ?>
        <p class="message"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form action="check.php" method="post">
        <input type="hidden" name="name" value="<?= htmlspecialchars($username) ?>">
        <p>コメント：<br>
        <textarea name="comment" rows="4" cols="40" required></textarea></p>
        <p><button type="submit" name="check" value="comment">投稿する</button></p>
    </form>

    <p><a href="view.php">▶ 投稿一覧を見る</a></p>
    <a class="a-tag" href="logout.php">ログアウト</a>
</body>
</html>
