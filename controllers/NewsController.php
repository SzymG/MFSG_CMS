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
        $model = new News();
        $CountAll = $model->CountAll();

        $pagination = new Pagination(['totalCount' => $CountAll, 'pageSize' => 10]);
        $SelectNews = $model->SelectNews($pagination->offset,$pagination->limit);

        return $this->render('news', ['model' => $model, 'SelectNews' => $SelectNews, 'pagination' => $pagination]);
    }

    public function actionShowone($NewsUrl, $NewsId)
    {
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
