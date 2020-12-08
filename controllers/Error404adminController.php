<?php
namespace app\controllers;
use Yii;
use app\models\Error404;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class Error404adminController extends Controller
{
    public $layout = 'admin';

    public function beforeAction($action)
    {
        $session = Yii::$app->session;
        if($session['yii_user_id'] != "")
        {
            if($session['yii_user_root'] != 1)
            {
                return $this->redirect(['/right']);
            }
        }
        else
        {
            return $this->redirect(['/login']);
        }

        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_user_watched_error404'));
        $dataProvider = new ActiveDataProvider([
            'query' => Error404::find(),
            'sort'=> ['defaultOrder' => ['error_id'=>SORT_DESC]]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
