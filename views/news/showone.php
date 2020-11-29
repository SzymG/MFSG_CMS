<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $model->news_title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'a_news_header'), 'url' => ['/news']];
$this->params['breadcrumbs'][] = $this->title;

echo '<h2>'.$model->news_title.'</h2>';
echo Yii::t('app', 'p_news_published').''.$model->news_date.'<br/><br/>
';
echo $model->news_text;
?>
