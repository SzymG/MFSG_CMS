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
        <?= Html::a(Yii::t('app', 'a_event_add'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'event_id',
            'event_title',
            'event_date',
            'event_date_start',
            'event_date_end',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url) {
                        return Html::a(
                            '<i class="fas fa-eye"></i>',
                            $url,
                            [
                                'title' => 'Zobacz',
                                'data-pjax' => '0',
                            ]
                        );
                    },
                    'update' => function ($url) {
                        return Html::a(
                            '<i class="fas fa-pencil-alt"></i>',
                            $url,
                            [
                                'title' => 'Edytuj',
                                'data-pjax' => '0',
                            ]
                        );
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="fas fa-trash-alt"></i>', ['delete', 'id' => $model['event_id']], [
                            'title' => Yii::t('app', 'com_delete_button'), 'data-confirm' => Yii::t('app', 'Czy na pewno chcesz usunąć?'),'data-method' => 'post']);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
