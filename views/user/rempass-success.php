<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'rem_password_header');
$this->params['breadcrumbs'][] = $this->title;

echo '<div class="alert alert-success" role="alert">'.Yii::t('app', 'rem_password_check_email').'</div>';
?>
