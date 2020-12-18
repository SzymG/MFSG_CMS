<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', ($success ? 'register_success_header' : 'register_failure_header'));
$this->params['breadcrumbs'][] = $this->title;

echo '<div class="alert '.($success ? 'alert-success' : 'alert-danger').'" role="alert">'.
    Yii::t('app', ($success ? 'register_success_comm' : 'register_failure_comm')).'</div>';
?>
