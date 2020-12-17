<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = Yii::t('app', 'a_page_text_header');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'a_admin'), 'url' => ['/admin/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pageadmin-index">

    <p>
        <?= Html::a(Yii::t('app', 'a_create_text_page_header'), ['create'], ['class' =>'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' =>'yii\grid\SerialColumn'],
            'page_id',
            'page_title',
            ['class' =>'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'delete' => function ($model, $key, $index) {
                        return $model->page_id == 1 ? false : true;
                    }
                ]],
        ],
    ]); ?>
</div>
