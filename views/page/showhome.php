<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

$this->title = $model->page_title;
echo '<h1>'.$model->page_title.'</h1>';
echo $model->page_text;
