<?php 
    //仮のユーザー登録
    $users = [
        'user1' => password_hash('password1', PASSWORD_DEFAULT),
        'admin' => password_hash('adminpass', PASSWORD_DEFAULT),
    ];
?>