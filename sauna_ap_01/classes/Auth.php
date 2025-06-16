<?php

//------------------------------------------------------
// 認証・セッション管理クラス
//-----------------------------------------------------

class Auth {
    // セッションを開始する（未開始の場合のみ）
    public static function start() {
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // ログインしていなければログインページへリダイレクトする
    public static function check() {
        self::start();
        if(!isset($_SESSION['user_id'])) {
            header('Location: ../login/login.php');
            exit;
        }
    }

    // ログイン中のユーザーIDを取得する
    public static function userId() {
        self::start();
        return $_SESSION['user_id'] ?? null;
    }

    // ログイン中のユーザー名を取得する
    public static function username() {
        self::start();
        return $_SESSION['username'] ?? null;
    }

    // ユーザーIDとユーザー名をセッションに保存（ログイン処理）
    public static function login($id, $username) {
        self::start();
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $username;
    }

    // セッションを破棄してログアウトする
    public static function logout() {
        self::start();
        session_destroy();
    }
}
?>