<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'p_event_no_event');
$this->params['breadcrumbs'][] = $this->title;

echo '<h1>'.Yii::t('app', 'p_event_no_event').'</h1>';
echo '<div class="alert alert-danger" role="alert">'.Yii::t('app', 'p_event_no_event_comm').'</div>';
