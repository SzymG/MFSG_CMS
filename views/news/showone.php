<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->news_title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'a_news_header'), 'url' => ['/news']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mx-4 mb-4 text-right"><?php echo $model->news_date ?></div>
<?php if(!empty($model->news_photo_url)): ?>
    <?= Html::img(Url::base().'/storage/index?f='.$model->news_photo_url, ['id' => 'current-image', 'style' => "width: 30%;", 'class' => 'mx-4 mb-2 float-left']); ?>
<?php endif; ?>
<div class="mx-4" ><?php echo  $model->news_text ?></div>
