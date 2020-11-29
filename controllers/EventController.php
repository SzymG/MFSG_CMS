<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\Event;
use yii\data\Pagination;

class EventController extends Controller
{
    // TODO wyrzucanie ze strony, jeśli jest przeznaczona tylko dla zalogownych
    public function actionIndex()
    {
        $model = new Event();
        $CountAll = $model->CountAll();

        $pagination = new Pagination(['totalCount' => $CountAll, 'pageSize' => 10]);

        $SelectEvents = $model->SelectEvents($pagination->offset,$pagination->limit);

        return $this->render('event', ['model' => $model, 'SelectEvents' => $SelectEvents, 'pagination' =>
            $pagination]);

    }

    public function actionShowone($EventUrl,$EventId)
    {
        $model = new Event();
        $IsThatPage = $model->SelectOneEvent($EventId);

        if($IsThatPage)
        {
            return $this->render('showone', ['model' => $model]);
        }
        else
        {
            return $this->render('event-noexists', ['model' => $model]);
        }
    }
}
