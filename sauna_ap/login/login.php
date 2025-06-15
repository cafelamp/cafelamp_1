<?php
    session_start();
    require 'db.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username']  ?? '');
        $password = $_POST['password'] ?? '';

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header(('Location: dashborad.php'));
            exit;
        } else {
            $error = "ログイン失敗 : ユーザー名またはパスワードが間違っています。";
        }
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
</head>
<body>
    <h2>ログイン</h2>
    <form method="post">
        ユーザー名: <input type="text" name="username"><br>
        パスワード: <input type="password" name="password"><br>
        <button type="submit">ログイン</button>
    </form>
    <?php if(!empty($error)) echo "<p style='color:red;'>$error</p>";?>
    <p><a href="register.php">新規登録はこちら</a></p>
</body>
</html>