<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

$this->title = $model->page_title;
?>

<div class="mx-4"><?php echo \yii\helpers\HtmlPurifier::process($model->page_text) ?></div>
