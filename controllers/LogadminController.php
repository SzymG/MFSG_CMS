<?php
namespace app\controllers;
use Yii;
use app\models\Logadmin;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class LogadminController extends Controller
{
    public $layout = 'admin';

    public function beforeAction($action)
    {
        $session = Yii::$app->session;
        if($session['yii_user_id'] != "")
            {
                if($session['yii_user_root'] != "y")
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
        Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_browse_logs'));
        $dataProvider = new ActiveDataProvider([
            'query' => Logadmin::find(),
            'sort'=> ['defaultOrder' => ['log_id'=>SORT_DESC]]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
