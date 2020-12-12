<?php

use app\helpers\UploadHelper;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<div class="eventadmin-form">
    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => false,
        'enableClientValidation' => false,
    ]); ?>

    <?= $form->field($model, 'event_title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'event_text')->textarea(['rows' => 6]) ?>
    <!-- <?= $form->field($model, 'event_date')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'event_date_start')->textInput() ?>
    <?= $form->field($model, 'event_date_end')->textInput() ?>
    <?= $form->field($model, 'event_url')->textInput(['maxlength' => true]) ?>
    <?php if(!empty($model->event_photo_url)): ?>
        <?= Html::img(Url::base().'/storage/index?f='.$model->event_photo_url, ['id' => 'current-image']); ?>
    <?php endif; ?>
    <?= $form->field($model, 'event_photo_url')->fileInput() ?>
    <?= $form->field($model, 'event_photo_url')->hiddenInput()->label(false); ?>
    <img id="url_icon-container">
    <?= $form->field($model, 'is_only_for_authorized')->checkbox() ?>
    <?= $form->field($model, 'is_active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'a_event_add') : Yii::t('app',
            'a_event_edit'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
