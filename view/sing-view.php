<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include_once(__DIR__ . '/parts/head.php'); ?>
    <title>新規登録</title>
</head>
<body>
    <header>
        <?php include_once(__DIR__ . '/parts/navi.php'); ?>
        <h1>新規登録</h1>
    </header>
    <main>
        <form action="" method="post">
            ユーザ名：<input type="text" name="userName" id=""><br>
            メールアドレス：<input type="email" name="userEmail" id=""><br>
            パスワード：<input type="password" name="userPassword" id=""><br>
            <button type="submit">登録</button>
        </form>
        <div class="error_mes">
            <?php
                if(count($error) > 0){
                    foreach($error as $val){ echo $val . '<br>'; }
                }
            ?>
        </div>
    </main>
    <?php include_once(__DIR__ . '/parts/footer.php'); ?>
</body>
</html>