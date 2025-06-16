<?php
// 認証・投稿クラスの読み込み
require_once '../classes/Auth.php';
require_once '../classes/Post.php';

// ログインチェック（未ログインならリダイレクト）
Auth::check();
// ログイン中のユーザーIDを取得
$userId = Auth::userId();

// フォーム送信時の処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = trim($_POST['content']); // 投稿内容を取得・前後空白除去
    if (!empty($content)) {
        // 新しい投稿を作成
        Post::create($userId, $content);
        // 投稿一覧ページへリダイレクト
        header('Location: timeline.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>投稿</title></head>
<body>
    <h2>SNSにサウナの感想を投稿</h2>
    <form method="post">
        <textarea name="content" rows="5" cols="40" placeholder="サウナの感想などをシェアしよう！" required></textarea><br>
        <button type="submit">投稿する</button>
    </form>
    <p><a href="timeline.php">投稿一覧へ</a></p>
</body>
</html>
