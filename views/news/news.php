<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$this->title = Yii::t('app', 'p_news_header');
$this->params['breadcrumbs'][] = $this->title;

echo LinkPager::widget([
    'pagination' => $pagination,
]);

echo '<h1>'.Yii::t('app', 'p_news_header').'</h1>';

for($Pages=0;$Pages<count($SelectNews);$Pages++)
{
    echo '<h2>'.$SelectNews[$Pages]['news_title'].'</h2>';
    echo Yii::t('app', 'p_news_published').$SelectNews[$Pages]['news_date'];
    echo '<p>'.substr(strip_tags($SelectNews[$Pages]['news_text']),0,350).'... '.
        Html::a('<nobr>'.Yii::t('app', 'p_news_read_more').'</nobr>',
            ['/news/'.$SelectNews[$Pages]['news_url'].'/'.$SelectNews[$Pages]['news_id']]).
        '</p>';
}

echo LinkPager::widget([
    'pagination' => $pagination,
]);
