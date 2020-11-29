<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = Yii::t('app', 'a_event_header');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'a_admin'), 'url' => ['/admin/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="eventadmin-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app', 'a_event_add'), ['create'], ['class' =>'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' =>'yii\grid\SerialColumn'],
            'event_id',
            'event_title',
            'event_author',
            'event_date',
            ['class' =>'yii\grid\ActionColumn', 'template'=>'{view} {update} {delete}'],
        ],
    ]); ?>
</div>
