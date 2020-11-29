<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->page_title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'a_admin'), 'url' => ['/admin/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'a_page_text_header'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pageadmin-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
<?= Html::a(Yii::t('app', 'a_edit_text_page_header'), ['update', 'id' => $model->page_id], ['class' =>'btn
btn-primary']) ?>
<?php

if($model->page_id != 1)
{
    echo Html::a(Yii::t('app', 'a_delete_text_page_button'), ['delete', 'id' => $model->page_id], [
        'class' =>'btn btn-danger',
        'data' => [
            'confirm' => Yii::t('app', 'a_delete_shure'),
            'method' =>'post',
        ],
    ]) ;
}
?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'page_id',
            'page_title',
            'page_text:ntext',
            'page_url',
            'is_only_for_authorized',
        ],
    ]) ?>
</div>
