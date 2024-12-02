<?php
//modelの読み込み
include_once(__DIR__ . '/model/functions.php');

$_SESSION = []; //セッション情報を空にする

$user = new userSystem();
$user->logout();

//TOPに遷移
header("Location: {$const(DIR)}");
exit();