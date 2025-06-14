<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>掲示板サンプル</h1>
    <section>
        <h2>投稿完了</h2>
        <button onclick="location.href='test.php'">戻る</button>
    </section>

    <?php

    //DB接続情報を設定
    $dsn =  "mysql:dbname=sample;host=localhost";
    $user = "root";
    $passwd = '';
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4");

    //DB接続と例外処理
    try {
        $pdo = new PDO($dsn, $user, $passwd, $options);
        echo "DB接続OK";
    } catch (PDOException $e) {
        echo "DB接続NG" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
    }



    //SQLの例外処理
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            //初期設定
            $name = $_POST['name'] ?? '';
            $contents = $_POST['contents'] ?? '';
            date_default_timezone_set('Asia/Tokyo');
            $created_at = date("Y-m-d H:i:s");

            //SQLを実行
            $regist = $pdo->prepare("INSERT INTO post(name, contents, created_at) VALUES (:name, :contents, :created_at)");
            $regist->execute([
                ':name' => $name,
                ':contents' => $contents,
                ':created_at' => $created_at
            ]);
            echo "登録成功";
        } catch (PDOException $e) {
            echo "登録失敗：" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
        }
    }

    ?>

</body>

</html>