<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = $model->news_title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'a_admin'), 'url' => ['/admin/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'a_news_header'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="newsadmin-view">

    <p>
        <?= Html::a(Yii::t('app', 'a_news_edit'), ['update', 'id' => $model->news_id], ['class' =>'btn btnprimary']) ?>
        <?= Html::a(Yii::t('app', 'a_news_delete'), ['delete', 'id' => $model->news_id], [
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
            'news_id',
            'news_title',
            'news_text:ntext',
            'news_date',
            'news_url',
            'news_photo_url',
            'is_only_for_authorized',
            'is_active',
            [
                'attribute'=>'news_photo_url',
                'value'=>Url::base().'/storage/index?f='.$model->news_photo_url,
                'format' => ['image',['height'=>'100']],
            ],
        ],
    ]) ?>
</div>
