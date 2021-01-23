<?php
namespace app\controllers;
use Yii;
use app\models\Useradmin;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class UseradminController extends Controller
{
    //public $layout = 'admin';

    public function beforeAction($action)
    {
        $session = Yii::$app->session;
        if($session['yii_user_id'] != "") {
            if ($session['yii_user_root'] != 1) {
                return $this->redirect(['/right']);
            }
        }
        else
        {
            return $this->redirect(['/login']);
        }

        return parent::beforeAction($action);
    }

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
//        Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_browse_users'));
        $dataProvider = new ActiveDataProvider([
            'query' => Useradmin::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $idText = 'ID: '.$id;
//        Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_browse_user_one'), $idText);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Useradmin(['scenario' => Useradmin::SCENARIO_NEW]);
        $TemporaryPasword = strtolower(Yii::$app->getSecurity()->generateRandomString(20));
        $Salt = Yii::$app->params['saltPassword'];
        $ReadyPassword = password_hash($TemporaryPasword.$Salt, PASSWORD_DEFAULT);
        $model->user_password = $ReadyPassword;
        $model->user_key = strtolower(Yii::$app->getSecurity()->generateRandomString(20));

        $model->user_register = date('Y-m-d H:i:s');
        $model->user_registered_ip = $_SERVER['REMOTE_ADDR'];
        $model->user_active = 1;
        $model->user_activated = date('Y-m-d H:i:s');
        $model->user_activated_ip = $_SERVER['REMOTE_ADDR'];

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_create_user_account'));
            return $this->redirect(['view', 'id' => $model->user_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'edit';

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_updated_user_account'));
            return $this->redirect(['view', 'id' => $model->user_id]);
        }
        else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_deleted_user_account'));
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Useradmin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'page_does_not_exists'));
        }
    }
}
