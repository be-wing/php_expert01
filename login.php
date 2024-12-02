<?php
include_once(__DIR__ . '/model/functions.php');

if($_POST){
    $user = new userSystem();
    if( $user->userEmailCheck($_POST['userEmail']) ){
        // 存在している　ログイン可
        $userName = $_POST['userName'];
        $userEmail = $_POST['userEmail'];
        $password = $_POST['userPassword'];
        $result = $user->login($userName,$userEmail,$password);
        if( is_null($result) ){
            $error[] = 'ユーザ名、メールアドレスが違っています';
        }else{
            //セッションに保存
            $_SESSION['userName'] = $result['userName'];
            $_SESSION['userKey'] = $result['userKey'];
            //TOPに遷移
            header("Location: {$const(DIR)}");
            exit();
        }
    }else{
        $error[] = '登録がありません';
    }
}

include_once(__DIR__ . '/view/login-view.php');