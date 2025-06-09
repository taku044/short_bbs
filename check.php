<?php
session_start();

$db = [
    'host' => "mysql321.phy.lolipop.lan",
    'user' => "LAA1554882",
    'pass' => "2301192",
    'dbname' => "LAA1554882-shortbbs"
];

// DB接続
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

function login($pdo)
{
    if (empty($_POST['name']) || empty($_POST['password'])) {
        setErrorAndRedirect('ログインに失敗しました。ユーザー名またはパスワードをご確認ください。1', 'login.php');
    }

    $stmt = $pdo->prepare('SELECT * FROM user WHERE username = ? AND password = ?');
    $stmt->execute([$_POST['name'], $_POST['password']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: https://aso2301192.hippy.jp/short_bbs/form.php");
        exit();
    } else {
        setErrorAndRedirect('ログインに失敗しました。ユーザー名またはパスワードをご確認ください。', 'login.php');
    }
}
function comment($pdo)
{
    if (empty($_SESSION['id']) || empty($_POST['comment'])) {
        setErrorAndRedirect('投稿に失敗しました。', 'form.php');
    }

try {
        $stmt = $pdo->prepare('INSERT INTO comment (user_id, content) VALUES (?, ?)');
        $stmt->execute([
            $_SESSION['id'],
            $_POST['comment'],
        ]);
        $_SESSION['message'] = "投稿に成功しました！";
        header("Location: https://aso2301192.hippy.jp/short_bbs/form.php");
        exit();
    } catch (PDOException $e) {
        setErrorAndRedirect('データベースエラー: ' . $e->getMessage(), 'form.php');
    }
}
function setErrorAndRedirect($message, $redirectPath)
{
    $_SESSION['login_error'] = $message;
    header("Location: https://aso2301192.hippy.jp/short_bbs/" . $redirectPath);
    exit();
}



// ログイン処理を実行
if ($_POST['check'] === 'login') {
    login($pdo);
} elseif ($_POST['check'] === 'comment') {
    comment($pdo);
}
?>
