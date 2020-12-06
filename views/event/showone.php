<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $model->event_title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'p_events_header'), 'url' => ['/event']];
$this->params['breadcrumbs'][] = $this->title;

// TODO wyświetlanie innych pól eventu
echo '<h1>'.$model->event_title.'</h1>';
echo Yii::t('app', 'p_event_date').''.$model->event_date.', '.Yii::t('app',
        'p_event_published').''.$model->event_date.'<br />';

echo $model->event_text;

