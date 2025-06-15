<?php
// =====================
// DB接続・セッション管理
// =====================
require '../login/db.php'; // DB接続ファイルを読み込む
session_start(); // セッション開始

// =====================
// ログインチェック
// =====================
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login/login.php'); // 未ログインならログインページへ
    exit;
}

// =====================
// 投稿データの取得
// =====================
try {
    $stmt = $pdo->prepare("SELECT * FROM sauna_records ORDER BY created_at DESC"); // 投稿を新しい順に取得
    $stmt->execute();
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC); // 結果を連想配列で取得
} catch (PDOException $e) {
    echo "データ取得失敗：" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
    $posts = [];
}

// =====================
// 投稿一覧の表示（HTML部分）
// =====================
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>投稿一覧</title>
</head>

<body>
    <h1>投稿一覧</h1>
    <?php if (empty($posts)): ?>
        <p>投稿はありません。</p>
        <form action="record.php" method="get">
            <button type="submit">新規投稿をする</button>
        </form>
    <?php else: ?>
        <ul style="list-style: none;">
            <?php foreach ($posts as $post): ?>
                <li>------------------------------------------</li>
                <li>No :<?php echo $post['id'] ?></li>
                <li>名前 :<?php echo htmlspecialchars($post['facility_name'], ENT_QUOTES, 'UTF-8') ?></li>
                <li>投稿内容 :<?php echo htmlspecialchars($post['comment'], ENT_QUOTES, 'UTF-8') ?></li>
                <li>日時 :<?php echo $post['created_at'] ?></li>
                <li>------------------------------------------</li>
            <?php endforeach; ?>
        </ul>
        <form action="record.php" method="get">
            <button type="submit">新規投稿をする</button>
        </form>
        <form action="../login/logout.php">
            <button type="submit">ログアウト</button>
        </form>
    <?php endif; ?>
</body>

</html>