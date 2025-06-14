<?php session_start();?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
</head>
<body>
    <h2>ログインフォーム</h2>
    <form method="POST" action="login.php">
        ユーザー名：<input type="text" name="username"><br>
        パスワード : <input type="password" name="password"><br>
        <input type="submit" value="ログイン">
    </form>
    

    <?php if(!empty($_SESSION['error'])): ?>
        <p style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>
</body>
</html>