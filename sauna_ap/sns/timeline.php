<?php
session_start();
require '../login/db.php';

$stmt = $pdo->query("
    SELECT sns_posts.*, users.username 
    FROM sns_posts 
    JOIN users ON sns_posts.user_id = users.id
    ORDER BY sns_posts.created_at DESC
    ");

$posts = $stmt->fetchALL();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿一覧</title>
</head>
<body>
    <h2>みんなのサウナ投稿</h2>

    <p><a href="post.php">自分も投稿する</a></p>

    <?php if(empty($posts)): ?>
        <p>まだ投稿がありません。</p>
    <?php else: ?>
        <ul>
            <?php foreach($posts as $p): ?>
                <strong><?php echo htmlspecialchars($p['username']); ?></strong>さんの投稿<br>
                投稿日：<?php echo htmlspecialchars($p['created_at']); ?><br>
                内容：<pre><?php echo nl2br(htmlspecialchars($p['content'])); ?></pre>
                <hr>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <p><a href="../login/logout.php">ログアウト</a></p>
</body>
</html>

