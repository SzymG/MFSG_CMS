<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;


$ConfigPage = Yii::$app->OtherFunctionsComponent->GetConfigData();

\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700');

$assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
$session = Yii::$app->session;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <meta name="description" content="<?php echo $ConfigPage['description']; ?>" />
    <meta name="keywords" content="<?php echo $ConfigPage['keywords']; ?>" />
    <title><?php echo Yii::t('app', 'a_logo'); ?></title>
    <?php $this->head() ?>
</head>
<script src="<?php echo Yii::$app->params['pageUrl']; ?>library/jquery-3.5.1.min.js"
        type="text/javascript"></script>
<script src="<?php echo Yii::$app->params['pageUrl']; ?>library/jquery.selection.js"></script>
<script src="<?php echo Yii::$app->params['pageUrl']; ?>library/jquery-ui.min.js"></script>

<link href="<?php echo Yii::$app->params['pageUrl']; ?>library/jquery-ui.css" rel="stylesheet" />
<link href="<?php echo Yii::$app->params['pageUrl']; ?>library/jquery-ui-timepicker-addon.css"
      rel="stylesheet" />
<script src="<?php echo Yii::$app->params['pageUrl']; ?>library/jquery-ui-timepicker-addon.js"></script>
<script src="<?php echo Yii::$app->params['pageUrl']; ?>library/ckeditor/ckeditor.js"></script>
<body class="hold-transition sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper">
    <!-- Navbar -->
    <?= $this->render('navbar', ['assetDir' => $assetDir]) ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?= $this->render('sidebar', ['assetDir' => $assetDir]) ?>

    <!-- Content Wrapper. Contains page content -->
    <?= $this->render('content', ['content' => $content, 'assetDir' => $assetDir]) ?>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <?= $this->render('control-sidebar') ?>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?= $this->render('footer') ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
