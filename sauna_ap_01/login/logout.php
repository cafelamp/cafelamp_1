<?php
require_once '../classes/Auth.php';

Auth::logout();

// ログインページへリダイレクト
header('Location: login.php');
exit;