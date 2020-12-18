<?php
namespace app\controllers;
use Yii;
use app\models\Configadmin;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ConfigadminController extends Controller
{
    //public $layout = 'admin';

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
        $model = new Configadmin();

        $ConfigUpdated = false;


        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_update_configuration'));
            $model->SaveUserData();
            $ConfigUpdated = true;
            return $this->render('config', [
                'model' => $model, 'ConfigUpdated' => $ConfigUpdated
            ]);

        }
        else
        {
            $model->DataInsert();
            return $this->render('config', [
                'model' => $model, 'ConfigUpdated' => $ConfigUpdated
            ]);
        }
    }
}
