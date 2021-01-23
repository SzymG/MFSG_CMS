<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use app\assets\AppAsset;

$this->title = Yii::t('app', 'rem_password_header');
$this->params['breadcrumbs'][] = $this->title;

$form = ActiveForm::begin([
    'id' =>'login-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => false,
]);

echo $form->field($model, 'user_email')->textInput(['maxlength' => true]);
echo $form->field($model, 'user_captcha')->widget(Captcha::className(), [
    'template' =>'<div class="row"><div class="col-lg-2">{image}</div><div class="col-lg10">{input}</div></div>',
    'captchaAction' =>'user/captcha'
]);

echo '<div cass="form-group">';
echo Html::submitButton(Yii::t('app', 'rem_password_button_submit'), ['class' =>'btn btn-primary']);
echo '</div>';

ActiveForm::end();

