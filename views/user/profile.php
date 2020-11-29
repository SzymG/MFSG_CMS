<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'profile_header');
$this->params['breadcrumbs'][] = $this->title;

if($dataChanged)
{
    echo '<div class="alert alert-success" role="alert">'.Yii::t('app', 'profile_data_updated').'</div>';
}

$form = ActiveForm::begin([
    'id' =>'login-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => false,
]);

echo $form->field($model, 'user_namesurname');
echo $form->field($model, 'user_phone');
echo $form->field($model, 'user_about')->textarea(['rows' =>'6']);

echo '<div cass="form-group">';
echo Html::submitButton(Yii::t('app', 'profile_update_submit'), ['class' =>'btn btn-primary']);
echo '</div>';

ActiveForm::end();
