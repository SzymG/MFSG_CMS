<?php

use yii\helpers\Html;
use yii\helpers\Url;

$session = Yii::$app->session;

?>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <?php
        if($session['yii_user_id'] != "") {
        ?>

        <li class="nav-item user-menu">
            <a href='<?= Url::to(['/profile'])?>' class="nav-link">
                <img src="<?= Url::to(['/image/anonymous-user.png'])?>" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline"><?php echo $session["yii_user_email"]?></span>
            </a>
        </li>

        <li class="nav-item">
            <?= Html::a('<i class="fas fa-sign-out-alt"></i>', ['/logout'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
        </li>

        <?php } else {?>
            <li class="nav-item d-none d-sm-inline-block">
                <?= Html::a(Yii::t('app', 'link_register'), ['/register'], ['class' => 'nav-link']) ?>
            </li>

            <li class="nav-item d-none d-sm-inline-block">
                <?= Html::a(Yii::t('app', 'link_remind'), ['/remind-password'], ['class' => 'nav-link']) ?>
            </li>

            <li class="nav-item">
                <?= Html::a('<i class="fas fa-sign-in-alt"></i>', ['/login'], ['class' => 'nav-link']) ?>
            </li>
        <?php } ?>
    </ul>
</nav>
