<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = Yii::t('app', 'a_users_main_header');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'a_admin'), 'url' => ['/admin/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="useradmin-index">

    <p>
        <?= Html::a(Yii::t('app', 'a_users_create_header'), ['create'], ['class' =>'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' =>'yii\grid\SerialColumn'],
            'user_id',
            'user_email:email',
            'user_namesurname',
            'user_register',
            'user_registered_ip',
            ['class' =>'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'delete' => function ($model, $key, $index) {
                        return $model->user_id == 1 ? false : true;
                    }
                ]
            ],
        ],
    ]); ?>
</div>

