<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="useradmin-form">

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => false,
        'enableClientValidation' => false,
    ]); ?>

    <?php
    if($model->isNewRecord)
    {
        echo $form->field($model, 'user_email')->textInput(['maxlength' => true]);
    }
    ?>

    <?= $form->field($model, 'user_namesurname')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'user_phone')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'user_about')->textarea(['rows' => 6]) ?>


    <?php
    $ItemToList[1] = Yii::t('app', 'a_yes');
    $ItemToList[0] = Yii::t('app', 'a_no');
    echo $form->field($model, 'user_root')->dropDownList($ItemToList);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'a_create_user_button') : Yii::t('app',
            'a_update_user_button'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
