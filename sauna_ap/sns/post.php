<?php
// =====================
// セッション開始・DB接続
// =====================
session_start();
require '../login/db.php';

// =====================
// ログインチェック
// =====================
if(!isset($_SESSION['user_id'])) {
    header('Location: ../login/login.php');
    exit;
}

// =====================
// 変数の初期化
// =====================
$error = '';

// =====================
// 投稿処理（フォーム送信時のみ）
// =====================
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = trim($_POST['content'] ?? '');

    if($content === '') {
        $error = '投稿内容を入力してください。';
    } else {
        $stmt = $pdo->prepare("INSERT INTO sns_posts (user_id, content) VALUES(?, ?)");
        $stmt->execute([$_SESSION['user_id'],$content]);

        header('Location: timeline.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿する</title>
</head>

<body>
    <h2>サウナ投稿</h2>

    <?php if($error): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php  endif; ?>

    <form method="post">
        <textarea name="content" rows="5" cols="50" placeholder="ととのった！最高だったサウナ体験など..."></textarea><br>
        <button type="submit">投稿する</button>
    </form>

    <p><a href="timeline.php">投稿一覧を見る</a></p>

</body>

</html>