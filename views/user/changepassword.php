<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'user_change_password');
$this->params['breadcrumbs'][] = $this->title;

if($passwordChanged)
{
    echo '<div class="alert alert-success" role="alert">'.Yii::t('app', 'user_password_changed').'</div>';
}

$form = ActiveForm::begin([
    'id' =>'login-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => false,
]);

echo $form->field($model, 'user_password')->label(Yii::t('app', 'user_old_password'))->passwordInput();
echo $form->field($model, 'user_password2')->passwordInput();
echo $form->field($model, 'user_password3')->passwordInput();

echo '<div cass="form-group">';
echo Html::submitButton(Yii::t('app', 'user_password_change_button'), ['class' =>'btn btn-primary']);
echo '</div>';

ActiveForm::end();

