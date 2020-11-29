<?php
use yii\helpers\Html;

$this->title = Yii::t('app', 'user_error404');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-error">
    <h1><?= Html::encode($this->title) ?></h1>
    <p><?php echo Yii::t('app', 'user_error404_com'); ?></p>
</div>

