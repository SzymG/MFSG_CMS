<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$this->title = Yii::t('app', 'p_events_header');
$this->params['breadcrumbs'][] = $this->title;

echo LinkPager::widget([
    'pagination' => $pagination,
]);

for($Events=0;$Events<count($SelectEvents);$Events++)
{
    echo '<div style="clear: both"><div class="mx-4 mb-4 float-right text-right">'.Yii::t('app', 'p_news_published').' '.$SelectEvents[$Events]['event_date'].'</div>';
    if(!empty($SelectEvents[$Events]['event_photo_url'])):
        echo Html::img(Url::base().'/storage/index?f='.$SelectEvents[$Events]['event_photo_url'], ['id' => 'current-image', 'style' => "width: 15%; float: left;", 'class' => 'mx-4 my-2']);
    endif;
    echo '<h2 class="mx-4">'.\yii\helpers\HtmlPurifier::process($SelectEvents[$Events]['event_title']).'</h2>';
    echo '<div>'.'<b>Rozpoczęcie:</b> '.$SelectEvents[$Events]['event_date_start'].'<br> <b>Zakończenie:</b> '.$SelectEvents[$Events]['event_date_end'].'</div>';
    echo '<p class="mt-3 mx-4">'.\yii\helpers\HtmlPurifier::process(substr(strip_tags($SelectEvents[$Events]['event_text']),0,300).'... ').
        Html::a('<nobr>'.Yii::t('app', 'p_news_read_more').'</nobr>',
            ['/event/'.$SelectEvents[$Events]['event_url'].'/'.$SelectEvents[$Events]['event_id']]).
        '</p></div>';
}

echo LinkPager::widget([
    'pagination' => $pagination,
]);

