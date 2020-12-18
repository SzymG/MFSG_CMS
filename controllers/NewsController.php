<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\News;
use yii\data\Pagination;

class NewsController extends Controller
{
    public function actionIndex()
    {
        Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_browse_news'));

        $model = new News();
        $CountAll = $model->CountAll();

        $pagination = new Pagination(['totalCount' => $CountAll, 'pageSize' => 10]);
        $SelectNews = $model->SelectNews($pagination->offset,$pagination->limit);

        return $this->render('news', ['model' => $model, 'SelectNews' => $SelectNews, 'pagination' => $pagination]);
    }

    public function actionShowone($NewsUrl, $NewsId)
    {
        $idText = 'ID: '.$NewsId;
        Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_browse_one_entry_news'), $idText);

        $model = new News();

        $IsThatPage = $model->SelectOneNews($NewsId);

        if($IsThatPage)
        {
            return $this->render('showone', ['model' => $model]);
        }
        else
        {
            return $this->render('news-noexists', ['model' => $model]);
        }

    }
}
