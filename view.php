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
    //$filename = 'comments.txt';
    // if (file_exists($filename)) {
    //     $lines = file($filename, FILE_IGNORE_NEW_LINES);
    //     foreach (array_reverse($lines) as $line) {
    //         [$time, $name, $comment] = explode("\t", $line);
    //         echo "<div class='post'>";
    //         echo "<p><strong>$name</strong> さん ($time)</p>";
    //         echo "<p>" . nl2br($comment) . "</p>";
    //         echo "</div><hr>";
    //     }
    session_start();
$db = [
    'host' => "mysql309.phy.lolipop.lan",
    'user' => "LAA1554882",
    'pass' => "Pass0503",
    'dbname' => "LAA1554882-pagepalette"
];

try {
    $pdo = new PDO(
        'mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'] . ';charset=utf8',
        $db['user'],
        $db['pass']
    );
} catch (PDOException $e) {
    die('データベース接続に失敗しました: ' . htmlspecialchars($e->getMessage()));
}
    $stmt = $pdo->prepare('SELECT * FROM comment WHERE user_id = ?');
    $stmt->execute([$_SESSION['user_id']]);
    $comment = $stmt->fetch();
    $count = $stmt->fetchColumn();
    if($count!="0"){
         foreach (array_reverse($lines) as $line) {
             echo "<div class='post'>";
             echo "<p><strong>$name</strong> さん ($time)</p>";
             echo "<p>" . nl2br($comment) . "</p>";
             echo "</div><hr>";
         }
    session_start();
    } else {
        echo "<p>まだ投稿がありません。</p>";
    }
    ?>
</body>
</html>
