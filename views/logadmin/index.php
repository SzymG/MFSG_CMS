<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = Yii::t('app', 'a_aplication_logs_header');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'a_admin'), 'url' => ['/admin/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blogadmin-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' =>'yii\grid\SerialColumn'],
            'log_id',
            [
                'label' =>'User',
                'class' =>'yii\grid\DataColumn',
                'value' => function ($data) {
                    global $TableUsers;
                    return $data->SelectUser($data->log_user_id);
                },
            ],
            'log_what',
            'log_message',
            'log_time',
            'log_ip',
        ],
    ]); ?>
</div>
