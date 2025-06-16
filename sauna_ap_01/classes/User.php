<?php
require_once 'Database.php';
require_once 'Auth.php';


//------------------------------------------------------
//登録・ログイン処理
//-----------------------------------------------------

class User
{
    // 新規ユーザーを登録する（パスワードはハッシュ化して保存）
    public static function register($username, $password)
    {
        $pdo = Database::getConnection();
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $hashed]);
    }

    // ユーザー名とパスワードでログイン認証を行う
    public static function login($username, $password)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            Auth::login($user['id'], $user['username']);
            return true;
        }
        return false;
    }

    // 指定したユーザー名が存在するかどうかを判定する
    public static function exists($username)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT id FROM  users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch() ? true : false;
    }
}
