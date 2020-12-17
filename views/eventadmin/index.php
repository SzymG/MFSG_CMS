<?php
use yii\helpers\Html;
use yii\grid\GridView;


$this->title = Yii::t('app', 'a_event_header');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'a_admin'), 'url' => ['/admin/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="eventadmin-index">

    <p>
        <?= Html::a(Yii::t('app', 'a_event_add'), ['create'], ['class' =>'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' =>'yii\grid\SerialColumn'],
            'event_id',
            'event_title',
            'event_date',
            'event_date_start',
            'event_date_end',
            ['class' => 'yii\grid\ActionColumn', 'template'=>'{view} {update} {delete}'],
        ],
    ]); ?>
</div>
