<?php
// 認証・投稿クラスの読み込み
require_once '../classes/Auth.php';
require_once '../classes/Post.php';

// ログインチェック（未ログインならリダイレクト）
Auth::check();
// ログイン中のユーザーIDを取得
$userId = Auth::userId();
// 投稿一覧を取得
$posts = Post::all();
?>

<!DOCTYPE html>
<html>
<head><title>投稿一覧</title></head>
<body>
    <h2>みんなのサウナ投稿</h2>
    <p><a href="post.php">自分も投稿する</a></p>

    <?php if (empty($posts)): ?>
        <p>まだ投稿がありません。</p>
    <?php else: ?>
        <?php foreach ($posts as $p): ?>
            <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
                <strong><?php echo htmlspecialchars($p['username']); ?></strong><br>
                <?php echo htmlspecialchars($p['created_at']); ?><br>
                <pre><?php echo nl2br(htmlspecialchars($p['content'])); ?></pre>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <p><a href="../login/dashboard.php">ダッシュボードに戻る</a></p>
</body>
</html>
