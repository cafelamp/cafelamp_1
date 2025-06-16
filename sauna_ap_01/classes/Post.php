<?php
require_once 'Database.php';

class Post {
    // SNS投稿一覧をユーザー名付きで新しい順にすべて取得する
    public static function all() {
        $pdo = Database::getConnection();
        $stmt = $pdo->query("
            SELECT sns_posts.*, users.username 
            FROM sns_posts 
            JOIN users ON sns_posts.user_id = users.id
            ORDER BY sns_posts.created_at DESC
        ");
        return $stmt->fetchAll();
    }

    // 新しいSNS投稿を作成する
    public static function create($userId, $content) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("INSERT INTO sns_posts (user_id, content) VALUES (?, ?)");
        $stmt->execute([$userId, $content]);
    }
}
?>