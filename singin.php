<?php
include_once(__DIR__ . '/model/functions.php');


if($_POST){
    $user = new userSystem();
    if( $user->userEmailCheck($_POST['userEmail']) ){
        //登録済み
        $error[] = '登録済みです';
    }else{
        //未登録
        $userName = $_POST['userName'];
        $userEmail = $_POST['userEmail'];
        $password = $_POST['userPassword'];
        $user->setUser($userName,$userEmail,$password);

        //TOPに遷移
        header("Location: {$const(DIR)}");
    }
}
include_once(__DIR__ . '/view/sing-view.php');