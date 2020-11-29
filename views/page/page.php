<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$this->title = Yii::t('app', 'a_title_pages');
$this->params['breadcrumbs'][] = $this->title;

echo LinkPager::widget([
    'pagination' => $pagination,
]);

echo '<h1>'.Yii::t('app', 'a_title_pages').'</h1>';
for($Pages=0;$Pages<count($SelectPages);$Pages++)
{
    echo '<h2>'.$SelectPages[$Pages]['page_title'].'</h2>';
    echo '<p>'.substr(strip_tags($SelectPages[$Pages]['page_text']),0,350).'... '.
        Html::a('<nobr>'.Yii::t('app', 'read_more').'</nobr>',
            ['/page/'.$SelectPages[$Pages]['page_url'].'/'.$SelectPages[$Pages]['page_id']]).
        '<p>';
}

echo LinkPager::widget([
    'pagination' => $pagination,
]);
