<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="pageadmin-form">

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => false,
        'enableClientValidation' => false,
    ]); ?>

    <?= $form->field($model, 'page_title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'page_text')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'page_url')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'is_only_for_authorized')->checkbox() ?>
    <?= $form->field($model, 'is_active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'a_create_user_button') : Yii::t('app',
            'a_update_user_button'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
