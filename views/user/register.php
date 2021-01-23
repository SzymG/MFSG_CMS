<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;

$this->title = Yii::t('app', 'register_header');
$this->params['breadcrumbs'][] = $this->title;

$form = ActiveForm::begin([
    'id' =>'login-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => false,
]);

echo $form->field($model, 'user_email')->textInput(['maxlength' => true]);
echo $form->field($model, 'user_password')->passwordInput();
echo $form->field($model, 'user_password2')->passwordInput();
echo $form->field($model, 'user_namesurname');
echo $form->field($model, 'user_phone');
echo $form->field($model, 'user_about')->textarea(['rows' =>'6']);

echo '<div cass="form-group">';
echo Html::submitButton(Yii::t('app', 'register_page_submit'), ['class' =>'btn btn-primary']);
echo '</div>';

ActiveForm::end();
