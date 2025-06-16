<?php
require_once 'Database.php';



class SaunaRecord {
    // サウナ記録を新規作成する（1件登録）
    public static function create($userId, $data) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("INSERT INTO sauna_records 
            (user_id, facility_name, visited_at, temperature, water_temp, comment) 
            VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $userId,
            $data['facility_name'],
            $data['visited_at'],
            $data['temperature'],
            $data['water_temp'],
            $data['comment']
        ]);
    }

    // 指定ユーザーのサウナ記録を新しい順ですべて取得する
    public static function getALLByUser($userId) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM sauna_records WHERE user_id = ? ORDER BY visited_at DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }
}
?>