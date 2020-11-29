<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $model->page_title;
$this->params['breadcrumbs'][] = $this->title;

echo '<h1>'.$model->page_title.'</h1>';
echo $model->page_text;
?>
