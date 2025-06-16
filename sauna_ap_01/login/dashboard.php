<?php
// 認証クラスの読み込み
require_once '../classes/Auth.php';

// ログインチェック（未ログインならリダイレクト）
Auth::check();
// ログイン中のユーザー名を取得
$username = Auth::username();
?>

<!DOCTYPE html>
<html>
<head><title>ダッシュボード</title></head>
<body>
    <h2>こんにちは、<?php echo htmlspecialchars($username); ?> さん！</h2>

    <ul>
        <li><a href="../record/record.php">サウナ記録を投稿</a></li>
        <li><a href="../record/my_records.php">自分の記録一覧</a></li>
        <li><a href="../sns/post.php">SNSに投稿する</a></li>
        <li><a href="../sns/timeline.php">みんなの投稿を見る</a></li>
        <li><a href="logout.php">ログアウト</a></li>
    </ul>
</body>
</html>
