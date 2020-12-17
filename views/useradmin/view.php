<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->user_email;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'a_admin'), 'url' => ['/admin/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'a_users_main_header'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="useradmin-view">

    <p>
<?= Html::a(Yii::t('app', 'a_users_update_header'), ['update', 'id' => $model->user_id], ['class' =>'btn
btn-primary']) ?>
<?php

if($model->user_id != 1)
{
    echo Html::a(Yii::t('app', 'a_users_delete_header'), ['delete', 'id' => $model->user_id], [
        'class' =>'btn btn-danger',
        'data' => [
            'confirm' => Yii::t('app', 'a_delete_shure'),
            'method' =>'post',
        ],
    ]);
}
?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user_id',
            'user_email:email',
            'user_namesurname',
            'user_phone',
            'user_about:ntext',
            'user_password',
            'user_key',
            'user_register',
            'user_registered_ip',
            'user_active',
            'user_activated',
            'user_activated_ip',
            'user_root',
        ],
    ]) ?>
</div>
