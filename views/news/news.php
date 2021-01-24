<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$this->title = Yii::t('app', 'p_news_header');
$this->params['breadcrumbs'][] = $this->title;

echo LinkPager::widget([
    'pagination' => $pagination,
]);

for($News=0;$News<count($SelectNews);$News++)
{

    echo '<div style="clear: both"><div class="mx-4 mb-4 float-right text-right">'.Yii::t('app', 'p_news_published').' '.$SelectNews[$News]['news_date'].'</div>';
    if(!empty($SelectNews[$News]['news_photo_url'])):
        echo Html::img(Url::base().'/storage/index?f='.$SelectNews[$News]['news_photo_url'], ['id' => 'current-image', 'style' => "width: 15%;", 'class' => 'mx-4 my-2 float-left']);
    endif;
    echo '<h2 class="mx-4">'.\yii\helpers\HtmlPurifier::process($SelectNews[$News]['news_title']).'</h2>';
    echo '<p class="mt-3 mx-4">'.\yii\helpers\HtmlPurifier::process(substr(strip_tags($SelectNews[$News]['news_text']),0,400).'... ') .
        Html::a('<nobr>'.Yii::t('app', 'p_news_read_more').'</nobr>',
            ['/news/'.$SelectNews[$News]['news_url'].'/'.$SelectNews[$News]['news_id']]).
        '</p></div>';
}

echo LinkPager::widget([
    'pagination' => $pagination,
]);
