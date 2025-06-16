必要なデータベース（テーブル）
users

利用箇所: ユーザー登録・ログイン・存在確認
カラム例: id, username, password
sauna_records

利用箇所: サウナ記録の登録・取得
カラム例: id, user_id, facility_name, visited_at, temperature, water_temp, comment
sns_posts

利用箇所: SNS投稿の作成・一覧取得
カラム例: id, user_id, content, created_at


##sampleデータベースの作成
---------------------------------------------------------------------------
CREATE DATABASE sample CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sample;
---------------------------------------------------------------------------


##users テーブル
---------------------------------------------------------------------------
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
---------------------------------------------------------------------------


##sauna_records テーブル
---------------------------------------------------------------------------
CREATE TABLE sauna_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    facility_name VARCHAR(100) NOT NULL,
    visited_at DATETIME NOT NULL,
    temperature FLOAT,
    water_temp FLOAT,
    comment TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
---------------------------------------------------------------------------


##sns_posts テーブル
---------------------------------------------------------------------------
CREATE TABLE sns_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    content TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
---------------------------------------------------------------------------