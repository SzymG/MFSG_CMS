<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'rem_password_header');
$this->params['breadcrumbs'][] = $this->title;

if($ViewPassChanged)
{
    echo '<div class="alert alert-success" role="alert">'.Yii::t('app', 'rem_password_yes').'</div>';
}


else
{
    echo '<div class="alert alert-danger" role="alert">'.Yii::t('app', 'rem_password_no').'</div>';
}
?>

