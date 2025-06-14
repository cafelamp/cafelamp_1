<?php
    session_start();
    //未ログインを強制リダイレクト
    if(!isset($_SESSION['username'])) {
        header('Location: index.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>ようこそ、<?php echo htmlspecialchars($_SESSION['username'])?>さん！</h1>
    <p><a href="logout.php">ログアウト</a></p>
</body>
</html>