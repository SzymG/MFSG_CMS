<?php
use yii\helpers\Html;

$this->title = Yii::t('app', 'no_right_header');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-error">
    <h1><?php echo Yii::t('app', 'no_right_header'); ?></h1>
    <p>
        <?php echo Yii::t('app', 'no_right_comm'); ?>
    </p>
</div>
