<?php
// 認証・ユーザークラスの読み込み
require_once '../classes/Auth.php';
require_once '../classes/User.php';

// セッション開始
Auth::start();

// エラーメッセージ用変数の初期化
$error = '';

// フォーム送信時の処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? ''); // ユーザー名の取得・前後空白除去
    $password = trim($_POST['password'] ?? ''); // パスワードの取得・前後空白除去

    // ログイン認証
    if (User::login($username, $password)) {
        header('Location: dashboard.php'); // 成功時はダッシュボードへリダイレクト
        exit;
    } else {
        $error = 'ログインに失敗しました'; // 失敗時はエラーメッセージ
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>ログイン</title></head>
<body>
    <h2>ログイン</h2>
    <?php if ($error): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form method="post">
        <input type="text" name="username" placeholder="ユーザー名"><br>
        <input type="password" name="password" placeholder="パスワード"><br>
        <button type="submit">ログイン</button>
    </form>
    <p><a href="register.php">新規登録はこちら</a></p>
</body>
</html>
