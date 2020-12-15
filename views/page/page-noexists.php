<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'a_title_page_dont_exists');
$this->params['breadcrumbs'][] = $this->title;

echo '<div class="alert alert-danger" role="alert">'.Yii::t('app', 'page_dont_exists').'</div>';
