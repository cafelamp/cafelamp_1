<?php
// 認証・ユーザークラスの読み込み
require_once '../classes/Auth.php';
require_once '../classes/User.php';

// セッション開始
Auth::start();

// エラーメッセージ・成功メッセージ用変数の初期化
$error = '';
$success = '';

// フォーム送信時の処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? ''); // ユーザー名の取得・前後空白除去
    $password = trim($_POST['password'] ?? ''); // パスワードの取得・前後空白除去

    // ユーザー名の重複チェック
    if (User::exists($username)) {
        $error = 'このユーザー名はすでに使用されています';
    } else {
        // 新規ユーザー登録
        User::register($username, $password);
        $success = '登録に成功しました！ログインしてください。';
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>新規登録</title></head>
<body>
    <h2>新規登録</h2>
    <?php if ($error): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <?php if ($success): ?>
        <p style="color:green;"><?php echo htmlspecialchars($success); ?></p>
    <?php endif; ?>
    <form method="post">
        <input type="text" name="username" placeholder="ユーザー名"><br>
        <input type="password" name="password" placeholder="パスワード"><br>
        <button type="submit">登録</button>
    </form>
    <p><a href="login.php">ログインはこちら</a></p>
</body>
</html>
