<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'p_news_no_entry');
$this->params['breadcrumbs'][] = $this->title;

echo '<div class="alert alert-danger" role="alert">'.Yii::t('app', 'p_news_no_entry_comm').'</div>';
