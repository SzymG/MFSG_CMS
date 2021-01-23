<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;

$this->title = Yii::t('app', 'login_header');
$this->params['breadcrumbs'][] = $this->title;

$form = ActiveForm::begin([
    'id' =>'login-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => false,
]);

echo $form->field($model, 'user_email')->textInput();
echo $form->field($model, 'user_password')->passwordInput();

echo '<div cass="form-group">';
echo Html::submitButton(Yii::t('app', 'login_page_submit'), ['class' =>'btn btn-primary']);
echo '</div>';

ActiveForm::end();

?>
