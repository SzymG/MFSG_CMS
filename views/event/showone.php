<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = $model->event_title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'p_events_header'), 'url' => ['/event']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="mx-4 mb-4 text-right"><?php echo $model->event_date ?></div>
<?php if(!empty($model->event_photo_url)): ?>
    <?= Html::img(Url::base().'/storage/index?f='.$model->event_photo_url, ['id' => 'current-image', 'style' => "width: 30%; float: left;", 'class' => 'mx-4 mb-2']); ?>
<?php endif; ?>
<div class="mb-2"><b>Rozpoczęcie: </b><?php echo $model->event_date_start ?><br><b>Zakończenie: </b><?php echo $model->event_date_end ?></div>

<div class="mx-4" ><?php echo $model->event_text ?></div>
