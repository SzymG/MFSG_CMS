<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', ($success ? 'rem_password_header' : 'rem_password_failure_header'));
$this->params['breadcrumbs'][] = $this->title;

echo '<div class="alert '.($success ? 'alert-success' : 'alert-danger').'" role="alert">'.
    Yii::t('app', ($success ? 'rem_password_check_email' : 'rem_password_check_failure_email')).'</div>';
?>
