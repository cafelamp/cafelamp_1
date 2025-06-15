<?php
session_start();
require 'db.php';

if($_SERVER['REQUEST_METHOD'] === 'POST')  {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    //入力チェック
    if($username == '' || $password === '') {
        $error = 'すべての項目を入力してください。';
    } else {
        //重複チェック
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);

        if($stmt->fetch()) {
            $error = 'そのユーザー名は既に使われています。';
        } else {
            //登録処理
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt= $pdo->prepare("INSERT INTO users (username, password) VALUES (?,?)");
            $stmt->execute([$username, $hash]);
            header('Location: login.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー登録</title>
</head>
<body>
    <h2>ユーザ登録</h2>
    <form method="post">
        ユーザー登録: <input type="text" name="username"><br>
        パスワード: <input type="password" name="password"><br>
        <button type="submit">登録</button>
    </form>
    <?php if(!empty($error)) echo "<p style='color:red;'>$error</p>";?>
    <p><a href="login.php">ログインへ</a></p>
</body>
</html>