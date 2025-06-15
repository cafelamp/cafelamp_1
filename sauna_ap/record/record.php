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
// 変数の初期化・POSTデータ取得
// =====================
$error = '';
$facility_name = $_POST['facility_name'] ?? '';
$visited_at = $_POST['visited_at'] ?? '';
$temperature = $_POST['temperature'] ?? '';
$water_temp = $_POST['water_temp'] ?? '';
$comment = $_POST['comment'] ?? '';

// =====================
// 日時の取得
// =====================
date_default_timezone_set('Asia/Tokyo');
$created_at = date("Y-m-d H:i:s");

// =====================
// 投稿処理（フォーム送信時のみ）
// =====================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($facility_name === '') {
        $error = '施設名は必須です';
    } else {
        $stmt = $pdo->prepare("
            INSERT INTO sauna_records
            (user_id, facility_name, visited_at, temperature, water_temp, comment)
            VALUES (?, ?, ?, ?, ?, ?)
            ");

        $stmt->execute([
            $_SESSION['user_id'],
            $facility_name,
            $visited_at,
            $temperature ?: null,
            $water_temp ?: null,
            $comment
        ]);

        header('Location: my_records.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>サウナ記録</title>
</head>

<body>
    <h2>サウナ記録フォーム</h2>

    <?php if ($error): ?>
        <p style="color:red"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="post">
        施設名: <input type="text" name="facility_name" required><br>
        日付: <input type="date" name="visited_at"><br>
        サウナ温度（℃）：<input type="number" name="temperature"><br>
        水風呂温度（℃）：<input type="number" name="water_temp"><br>
        感想:<br>
        <textarea name="comment" rows="5" cols="40"></textarea><br>
        <button type="submit">記録する</button>
    </form>
</body>

</html>