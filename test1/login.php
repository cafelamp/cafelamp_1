<?php
    session_start();
    require 'users.php';

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if((isset($users[$username])) && password_verify($password, $users[$username])) {
        //ログイン成功
        $_SESSION['username'] = $username;
        header('Location: welcome.php');
        exit;
    } else {
        $_SESSION['error'] = 'ユーザー名またはパスワードが間違っています';
        header('Location: index.php');
        exit;
    }
?>