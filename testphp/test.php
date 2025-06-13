<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
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

    //SQLを実行
    try {
        $regist = $pdo->prepare("SELECT * FROM post");
        $regist->execute();
        echo "登録成功";
    } catch(PDOException $e) {
        echo "登録失敗";
    }

    ?>

    <h1>掲示板サンプル</h1>
    <form action="send.php" method="post">
        名前 : <input type="text" name="name" value=""><br>
        投稿内容: <input type="text" name="contents" value=""><br>
        <button type="submit">投稿</button>
    </form>

    <section>
        <h2>投稿内容一覧</h2>
        <?php foreach ($regist as $loop): ?>
            <div>No :<?php echo $loop['id'] ?></div>
            <div>名前 :<?php echo $loop['name'] ?></div>
            <div>投稿内容 :<?php echo $loop['contents'] ?></div>
            <div>------------------------------------------</div>
        <?php endforeach; ?>
    </section>
</body>

</html>