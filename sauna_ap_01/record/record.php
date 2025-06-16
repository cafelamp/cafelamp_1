<?php
// 認証・サウナ記録クラスの読み込み
require_once '../classes/Auth.php';
require_once '../classes/SaunaRecord.php';

// ログインチェック（未ログインならリダイレクト）
Auth::check();
// ログイン中のユーザーIDを取得
$userId = Auth::userId();

// フォーム送信時の処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 入力データを配列にまとめる
    $data = [
        'facility_name' => $_POST['facility_name'],
        'visited_at' => $_POST['visited_at'],
        'temperature' => $_POST['temperature'],
        'water_temp' => $_POST['water_temp'],
        'comment' => $_POST['comment']
    ];
    // サウナ記録を新規登録
    SaunaRecord::create($userId, $data);
    // 一覧ページへリダイレクト
    header('Location: my_records.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>サウナ記録</title></head>
<body>
    <h2>サウナ記録を投稿</h2>
    <form method="post">
        施設名: <input type="text" name="facility_name" required><br>
        訪問日: <input type="date" name="visited_at"><br>
        サウナ温度: <input type="number" name="temperature"> ℃<br>
        水風呂温度: <input type="number" name="water_temp"> ℃<br>
        コメント:<br>
        <textarea name="comment"></textarea><br>
        <button type="submit">記録する</button>
    </form>
    <p><a href="../login/dashboard.php">ダッシュボードに戻る</a></p>
</body>
</html>
