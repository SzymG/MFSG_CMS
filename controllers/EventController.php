<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\Event;
use yii\data\Pagination;

class EventController extends Controller
{
    public function actionIndex()
    {
        Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_browse_events'));

        $model = new Event();
        $CountAll = $model->CountAll();

        $pagination = new Pagination(['totalCount' => $CountAll, 'pageSize' => 10]);

        $SelectEvents = $model->SelectEvents($pagination->offset,$pagination->limit);

        return $this->render('event', ['model' => $model, 'SelectEvents' => $SelectEvents, 'pagination' =>
            $pagination]);

    }

    public function actionShowone($EventUrl,$EventId)
    {
        $idText = 'ID: '.$EventId;
        Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_browse_one_event'), $idText);

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
