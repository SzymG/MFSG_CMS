<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;

$this->title = Yii::t('app', 'a_title_config');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'a_admin'), 'url' => ['/admin/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="useradmin-create">

<?php

if($ConfigUpdated)
{
    echo '<div class="alert alert-success" role="alert">'.Yii::t('app', 'a_config_options_updated').'</div>';
}
?>
    <div class="useradmin-form">


        <?php $form = ActiveForm::begin([
            'enableAjaxValidation' => false,
            'enableClientValidation' => false,
        ]); ?>

        <?= $form->field($model, 'config_title'); ?>
        <?= $form->field($model, 'config_description'); ?>
        <?= $form->field($model, 'config_keywords'); ?>
        <?= $form->field($model, 'config_rootemail'); ?>
        <?= $form->field($model, 'config_foot'); ?>
        <?= $form->field($model, 'config_smtp_host'); ?>
        <?= $form->field($model, 'config_smtp_password'); ?>
        <?= $form->field($model, 'config_smtp_port'); ?>
        <?= $form->field($model, 'config_smtp_is_ssl')->checkbox(); ?>
        <?= $form->field($model, 'config_smtp_address_from'); ?>
        <?= $form->field($model, 'config_smtp_address_from_name'); ?>
        <?= $form->field($model, 'config_smtp_noreply'); ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'a_config_update_button'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

