<?php
use yii\helpers\Html;

$this->title = Yii::t('app', 'user_error404');
$this->params['breadcrumbs'][] = $this->title;
$this->registerAssetBundle('app\assets\AppAsset');

?>

<div class="site-error">
    <div class="mainbox">
        <div class="err">4</div>
        <div class="far-ghost"></div>
        <i class="far fa-question-circle fa-spin"></i>
        <div class="err2">4</div>
    </div>
    <p class="err-message"><?php echo Yii::t('app', 'user_error404_com'); ?></p>
</div>

