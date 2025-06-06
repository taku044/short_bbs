<?php 
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
if (isset($_POST['username']) && !$_POST['username'] == "") {
    $user=$_POST['username'];
    $password=$_POST['password'];
    $stmt = $pdo->prepare('SELECT * FROM user WHERE username = ?');
    $stmt->execute([$username]);
    $userin = $stmt->fetch();

    if ($user && password_verify($password, $userin['password'])) {
        $_SESSION['username'] = $user;
        $_SESSION['user_id']=$userin['id'];
        header("Location: form.php");
    } else {
       header("Location: login.php");
   }
}

?>