<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<div class="newsadmin-form">
    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => false,
        'enableClientValidation' => false,
    ]); ?>

    <?= $form->field($model, 'news_title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'news_text')->textarea(['rows' => 6]) ?>
    <!--<?= $form->field($model, 'news_date')->textInput() ?> -->
    <?= $form->field($model, 'news_url')->textInput(['maxlength' => true]) ?>
    <?php if(!empty($model->news_photo_url)): ?>
        <?= Html::img(Url::base().'/storage/index?f='.$model->news_photo_url, ['id' => 'current-image']); ?>
    <?php endif; ?>
    <?= $form->field($model, 'news_photo_url')->fileInput() ?>
    <?= $form->field($model, 'news_photo_url')->hiddenInput()->label(false); ?>
    <img id="url_icon-container">
    <?= $form->field($model, 'is_only_for_authorized')->checkbox() ?>
    <?= $form->field($model, 'is_active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'a_news_add') : Yii::t('app', 'a_news_edit'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
</div>

