<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'register_success_header');
$this->params['breadcrumbs'][] = $this->title;

echo '<div class="alert alert-success" role="alert">'.Yii::t('app', 'register_success_comm').'</div>';
?>
