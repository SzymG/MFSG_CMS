<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'user_activate_account');
$this->params['breadcrumbs'][] = $this->title;

if($MessageGood)
{
    echo '<div class="alert alert-success" role="alert">'.Yii::t('app', 'user_activate_yes').'</div>';
}

else
{
    echo '<div class="alert alert-danger" role="alert">'.Yii::t('app', 'user_activate_no').'</div>';
}
