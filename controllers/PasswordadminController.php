<?php
namespace app\controllers;
use Yii;
use app\models\Passwordadmin;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class PasswordadminController extends Controller
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
        Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_browse_recomm_password'));
        $dataProvider = new ActiveDataProvider([
            'query' => Passwordadmin::find(),
            'sort'=> ['defaultOrder' => ['password_id'=>SORT_DESC]]
        ]);


        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
