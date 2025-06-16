<?php
// 認証・サウナ記録クラスの読み込み
require_once '../classes/Auth.php';
require_once '../classes/SaunaRecord.php';

// ログインチェック（未ログインならリダイレクト）
Auth::check();
// ログイン中のユーザーIDを取得
$userId = Auth::userId();
// 自分のサウナ記録をすべて取得
$records = SaunaRecord::getAllByUser($userId);
?>

<!DOCTYPE html>
<html>
<head><title>自分のサウナ記録</title></head>
<body>
    <h2>あなたのサウナ記録</h2>

    <?php if (empty($records)): ?>
        <p>まだ記録がありません。</p>
        <p><a href="record.php">新しく記録する</a></p>
    <?php else: ?>
        <ul>
        <?php foreach ($records as $rec): ?>
            <li>
                <strong><?php echo htmlspecialchars($rec['facility_name']); ?></strong><br>
                訪問日: <?php echo htmlspecialchars($rec['visited_at']); ?><br>
                サウナ: <?php echo htmlspecialchars($rec['temperature']); ?>℃<br>
                水風呂: <?php echo htmlspecialchars($rec['water_temp']); ?>℃<br>
                コメント: <?php echo nl2br(htmlspecialchars($rec['comment'])); ?>
            </li>
            <hr>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <p><a href="../login/dashboard.php">戻る</a></p>
</body>
</html>
