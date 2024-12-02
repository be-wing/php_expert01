<?php
    if( isset($_SESSION['userName']) ){
        echo '<p>' , $_SESSION['userName'] , ' さん</p>';
    }
?>
<nav>
    <ul>
        <?php if( isset($_SESSION['userName']) ){  ?>
            <li><a href="<?php echo DIR ?>">TOP</a></li>
            <li><a href="<?php echo DIR ?>mypage.php">マイページ</a></li>
            <li><a href="<?php echo DIR ?>logout.php">ログアウト</a></li>
        <?php }else{ ?>
            <li><a href="<?php echo DIR ?>TOP.php">TOP</a></li>
            <li><a href="<?php echo DIR ?>login.php">ログイン</a></li>
            <li><a href="<?php echo DIR ?>singin.php">新規登録</a></li>
        <?php } ?>
    </ul>
</nav>
