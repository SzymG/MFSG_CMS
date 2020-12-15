<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $model->page_title;
$this->params['breadcrumbs'][] = $this->title;

echo $model->page_text;
?>
