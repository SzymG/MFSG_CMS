<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = $model->event_title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'a_admin'), 'url' => ['/admin/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'a_event_header'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="eventadmin-view">
    <p>
        <?= Html::a(Yii::t('app', 'a_event_edit'), ['update', 'id' => $model->event_id], ['class' =>'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'a_event_delete'), ['delete', 'id' => $model->event_id], [
            'class' =>'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'a_delete_shure'),
                'method' =>'post',
            ],
        ]) ?>
    </p>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'event_id',
            'event_title',
            'event_text:ntext',
            'event_date',
            'event_date_start',
            'event_date_end',
            'event_url',
            'is_only_for_authorized',
            'is_active',
            [
                'attribute'=>'event_photo_url',
                'value'=>Url::base().'/storage/index?f='.$model->event_photo_url,
                'format' => ['image',['height'=>'100']],
            ],
        ],
    ]) ?>
</div>
