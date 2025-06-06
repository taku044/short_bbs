<?php 
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
if (isset($_POST['username']) && !$_POST['username'] == "") {
    $user=$_POST['username'];
    $password=$_POST['password'];
    $stmt = $pdo->prepare('SELECT password FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
    } else {
       header("Location: login.php");
   }
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
    <form action="post.php" method="post">
        <p>ようこそ、    
        <?php 
        echo $_POST['username'];
        ?>
        さん</p>
        <p>コメント：<br>
        <textarea name="comment" rows="4" cols="40" required></textarea></p>
        <p><button type="submit">投稿する</button></p>
    </form>
    <p><a href="view.php">▶ 投稿一覧を見る</a></p>
    <p><a href="logout.php">ログアウト</a></p>

</body>
</html>
