<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$this->title = Yii::t('app', 'p_events_header');
$this->params['breadcrumbs'][] = $this->title;

echo LinkPager::widget([
    'pagination' => $pagination,
]);

echo '<h1>events</h1>';

for($Pages=0;$Pages<count($Selectevents);$Pages++)
{
    // TODO dodać wyświetlanie innych pól eventu
    echo '<h2>'.$Selectevents[$Pages]['event_title'].'</h2>';
    echo Yii::t('app', 'p_event_author').''.$Selectevents[$Pages]['event_author'].', '.Yii::t('app',
            'p_event_published').''.$Selectevents[$Pages]['event_date'];
    echo '<p>'.substr(strip_tags($SelectEvents[$Pages]['event_text']),0,350).'... '.
        Html::a('<nobr>'.Yii::t('app', 'p_event_read_more').'</nobr>',
            ['/event/'.$SelectEvents[$Pages]['event_url'].'/'.$SelectEvents[$Pages]['event_id']]).
        '</p>';
}

echo LinkPager::widget([
    'pagination' => $pagination,
]);

