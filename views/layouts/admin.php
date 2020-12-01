<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

$session = Yii::$app->session;
if(!$session->isActive)
{
    $session->open();
}

$ConfigPage = Yii::$app->OtherFunctionsComponent->GetConfigData();

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <meta name="description" content="<?php echo $ConfigPage['description']; ?>" />
    <meta name="keywords" content="<?php echo $ConfigPage['keywords']; ?>" />
    <title><?php echo Yii::t('app', 'a_logo'); ?></title>
<?php $this->head() ?>
    <script src="<?php echo Yii::$app->params['pageUrl']; ?>library/jquery-3.5.1.min.js"
            type="text/javascript"></script>
    <script src="<?php echo Yii::$app->params['pageUrl']; ?>library/jquery.selection.js"></script>
    <script src="<?php echo Yii::$app->params['pageUrl']; ?>library/jquery-ui.min.js"></script>
    <link href="<?php echo Yii::$app->params['pageUrl']; ?>library/jquery-ui.css" rel="stylesheet" />
    <link href="<?php echo Yii::$app->params['pageUrl']; ?>library/jquery-ui-timepicker-addon.css"
          rel="stylesheet" />
    <script src="<?php echo Yii::$app->params['pageUrl']; ?>library/jquery-ui-timepicker-addon.js"></script>
    <script src="<?php echo Yii::$app->params['pageUrl']; ?>library/ckeditor/ckeditor.js"></script>
    <style>
        .my-navbar
        {
            background-color: #F5F5F5;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>
    <div class="wrap">
<?php
NavBar::begin([
    'brandLabel' => Yii::t('app', 'a_logo'),
    'brandUrl' => Yii::$app->homeUrl.'configadmin/index',
    'options' => [
        'class' =>'my-navbar navbar-fixed-top',
    ],
]);
echo Nav::widget([
    'options' => ['class' =>'navbar-nav navbar-right'],
    'items' => [
        ['label' => Yii::t('app', 'a_amenu_config'), 'url' => ['/configadmin/index']],
        ['label' => Yii::t('app', 'a_amenu_page'), 'url' => ['/pageadmin/index']],
        ['label' => Yii::t('app', 'a_amenu_events'), 'url' => ['/.eventadmin/index']],
        ['label' => Yii::t('app', 'a_amenu_news'), 'url' => ['/newsadmin/index']],
        ['label' => Yii::t('app', 'a_amenu_users'), 'items' =>
            [
                ['label' => Yii::t('app', 'a_amenu_users'), 'url' => ['/useradmin/index']],
                ['label' => Yii::t('app', 'a_amenu_password_change'), 'url' => ['/passwordadmin/index']],
                ['label' => Yii::t('app', 'a_amenu_logs'), 'url' => ['/logadmin/index']],
            ]
        ],
        ['label' => Yii::t('app', 'a_amenu_left_menu'), 'url' => ['/leftmenuadmin/index']],
        ['label' => Yii::t('app', 'a_error404_header'), 'url' => ['/error404admin/index']],
        ['label' => Yii::t('app', 'a_amenu_logout'), 'url' => ['/logout']],
    ],
]);
NavBar::end();
?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>
<footer class="footer">
    <div class="container">
        <p class="pull-left"><?php echo $ConfigPage['foot']; ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<?php
$session->close();
?>
