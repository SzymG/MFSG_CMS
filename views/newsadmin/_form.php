<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="newsadmin-form">
    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => false,
        'enableClientValidation' => false,
    ]); ?>

    <?= $form->field($model, 'news_title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'news_text')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'news_date')->textInput() ?>
    <?= $form->field($model, 'news_url')->textInput(['maxlength' => true]) ?>
<!--    TODO tutaj zmienić na upload zdjęć -->
    <?= $form->field($model, 'news_photo_url')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'is_only_for_authorized')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'a_news_add') : Yii::t('app', 'a_news_edit'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
</div>
