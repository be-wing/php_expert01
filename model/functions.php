<?php
//sessionの発行
session_start();

//ディレクトリ
$document_root = str_replace('/' , '\\',$_SERVER['DOCUMENT_ROOT']);
$rootDir = str_replace($document_root, '', __DIR__);
$rootDir = str_replace(basename(__DIR__), '', $rootDir);
define('DIR', $rootDir);


//データの登録
//DB接続情報の定義
$DB_NAME = 'php_1202_db';
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DSN', "mysql:host=localhost; dbname={$DB_NAME}; charset=utf8");

//エラー表示用
$error =[];


//文字列内で定数を展開して表示する
$const = function($const){ return $const; };

//ユーザのログイン　サインイン　ログアウトを管理するクラス
class userSystem{
    private $dbh;
    function __construct(){
        try{
            $this->dbh = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
        } catch (Exception $e) {
            var_dump( $e->getMessage() );
        }
    }
    //メールチェック用
    public function userEmailCheck($email){
        $sql = 'SELECT * FROM `users` WHERE `userEmail` = :mail';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':mail', $email);
        //クエリの実行
        $stmt->execute();
        //実行結果を取得
        $data = []; //結果一覧の配列を用意
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
        if(count($data) < 1){
            //1件未満　存在しない
            return false;
        }else{
            //それ以外　存在する
            return true;
        }
    }
    //ユーザ登録処理
    public function setUser($userName,$userEmail,$password){
        $password = password_hash($password, PASSWORD_DEFAULT);//パスワードのハッシュ化
        $userKey =  hash( "sha256", $userEmail);//userを認識するためのキーとして利用する
        //user テーブルに 同じEmailが存在するか確認
        $sql = "
        INSERT INTO `users`
        (`id`, `userName`, `userEmail`, `userPassword`, `userKey`)
        VALUES (:id,:name,:email,:pass,:key)";
        $stmt = $this->dbh->prepare($sql);
        //バインド
        $stmt->bindValue(':id', null, PDO::PARAM_NULL);
        $stmt->bindValue(':name', $userName);
        $stmt->bindValue(':email', $userEmail);
        $stmt->bindValue(':pass', $password);
        $stmt->bindValue(':key', $userKey);
        //クエリの実行
        $result = $stmt->execute();
        if($result){
            //成功の場合
            return true;
        }else{
            return false;
        }
    }
    //ユーザ情報の取得
    private function getUser($userEmail){
        $sql = 'SELECT * FROM `users` WHERE `userEmail` = :mail';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':mail', $userEmail);
        //クエリの実行
        $stmt->execute();
        //実行結果を取得
        $data = $stmt->fetchAll();
        return $data[0];
    }
    //ログイン処理
    public function login($userName,$userEmail,$password){
        //ユーザ情報の取得
        $userData = $this->getUser($userEmail);
        //ユーザー名：パスワードが同じか確認
        if(
            password_verify( $password , $userData['userPassword'])
            &&
            $userData['userName'] == $userName
        ){
            return $userData;
        }else{
            return null;
        }
    }
    //ログアウト処理
    public function logOut(){
        session_destroy();//セッションを削除
    }
}

