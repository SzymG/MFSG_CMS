<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $model->page_title;
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="mx-4"><?php echo \yii\helpers\HtmlPurifier::process($model->page_text) ?></div>
