<?php
  
    // データベース接続文字列
    $dsn = "mysql:dbname=sample;host=localhost";

    // 接続ユーザー名
    $username = 'root';

    //接続時のパスワード
    $passwd = '';

    // 接続オプション
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4");

    try {
        $pdo = new PDO($dsn, $username, $passwd, $options);
    } catch(PDOException $e) {
        echo "DB接続NG" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
    }

    ?>