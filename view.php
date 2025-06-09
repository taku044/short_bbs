<?php
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'ゲスト';
$id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
$message = isset($_SESSION['message']) ? $_SESSION['message'] : null;

if (isset($_SESSION['login_error'])) {
    echo '<p class="error-message">' . htmlspecialchars($_SESSION['login_error']) . '</p>';
    unset($_SESSION['login_error']);
}

$db = [
    'host' => "mysql321.phy.lolipop.lan",
    'user' => "LAA1554882",
    'pass' => "2301192",
    'dbname' => "LAA1554882-shortbbs"
];

try {
    $pdo = new PDO(
        'mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'] . ';charset=utf8',
        $db['user'],
        $db['pass'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die('データベース接続失敗: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>一言掲示板 - 投稿一覧</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>📜 投稿一覧</h1>
    <p><a href="form.php">← 投稿フォームへ戻る</a></p>
    <hr>
    <?php
    if ($id) {
        $stmt = $pdo->prepare('SELECT * FROM comment WHERE user_id = ? ORDER BY creant_at DESC');
        $stmt->execute([$id]);
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($comments) {
            foreach ($comments as $comment) {
                echo "<div class='post'>";
                echo "<p><strong>" . htmlspecialchars($username) . "</strong> さん (" . htmlspecialchars($comment['creant_at']) . ")</p>";
                echo "<p>" . nl2br(htmlspecialchars($comment['content'])) . "</p>";
                echo "</div><hr>";
            }
        } else {
            echo "<p>まだ投稿がありません。</p>";
        }
    } else {
        echo "<p>ログインユーザーの投稿のみを表示できます。</p>";
    }
    ?>
</body>
</html>
