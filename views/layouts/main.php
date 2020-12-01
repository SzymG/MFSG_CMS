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

$ItemsMenu = Yii::$app->OtherFunctionsComponent->GetMenu($session['yii_user_id']);

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
    <title><?php
        if($this->title != "")
        {
            echo Html::encode($this->title).' - '.$ConfigPage['title'];
        }
        else
        {
            echo $ConfigPage['title'];
        }
        ?></title>
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
    'brandLabel' => Yii::t('app', 'page_title_header'),
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' =>'my-navbar navbar-fixed-top',
    ],
]);

if($session['yii_user_id'] == "")
{
    echo Nav::widget([
        'options' => ['class' =>'navbar-nav navbar-right'],
        'items' => [
            ['label' => Yii::t('app', 'link_home'), 'url' => ['/']],
            ['label' => Yii::t('app', 'link_login'), 'url' => ['/login']],
            ['label' => Yii::t('app', 'link_register'), 'url' => ['/register']],
            ['label' => Yii::t('app', 'link_remind'), 'url' => ['/remind-password']],
        ],
    ]);
}
else

{
    echo Nav::widget([
        'options' => ['class' =>'navbar-nav navbar-right'],
        'items' => [
            ['label' => Yii::t('app', 'link_home'), 'url' => ['/']],
            ['label' => Yii::t('app', 'link_profile'), 'url' => ['/profile']],
            ['label' => Yii::t('app', 'link_logout'), 'url' => ['/logout']],
        ],
    ]);
}
NavBar::end();
?>

    <div class="container">
<?= Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>

        <div class="row">
            <div class="col-md-2"><?php
                echo Nav::widget([
                    'options' => ['class' =>'sidebar-menu treeview'],
                    'items' => $ItemsMenu ]);
                ?></div>

            <div class="col-md-10">
                <?= $content ?></div>
        </div>
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
