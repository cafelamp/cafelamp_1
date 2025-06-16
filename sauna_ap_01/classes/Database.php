<?php

//------------------------------------------------------
// 共通DB接続クラス
//-----------------------------------------------------

class Database {
    // PDOインスタンスを保持する静的プロパティ
    private static $pdo;

    // データベース接続（PDOインスタンス）を取得する
    public static function getConnection() {
        if(!self::$pdo) {
            self::$pdo = new PDO('mysql:host=localhost;dbname=sample;charset=utf8', 'root', '');
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }
}
?>