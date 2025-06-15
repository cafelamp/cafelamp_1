<?php

session_start();
if(!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ダッシュボード</title>
</head>
<body>
    <h1>ようこそ、<?php echo htmlspecialchars($_SESSION['username']); ?>さん</h1>
    <p><a href="../record/my_records.php">サウナの記録を見る</a></p>
    <p><a href="../sns/timeline.php">みんなの投稿を見る</a></p>
    <p><a href="logout.php">ログアウト</a></p>
</body>
</html>