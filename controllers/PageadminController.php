<?php
namespace app\controllers;
use Yii;
use app\models\Pageadmin;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class PageadminController extends Controller
{
    public $layout = 'admin';

    public function beforeAction($action)
    {
        $session = Yii::$app->session;

        if ($session['yii_user_id'] != "") {
            if ($session['yii_user_root'] != "y") {
                return $this->redirect(['/right']);
            }
        } else {
            return $this->redirect(['/login']);
        }

        return parent::beforeAction($action);
    }

    public function behaviors()
    {
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
        Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_browse_page'));
        $dataProvider = new ActiveDataProvider([
            'query' => Pageadmin::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $idText = 'ID: '.$id;
        Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_browse_one_page'), $idText);

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Pageadmin();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $idText = 'ID: '.$model->page_id;
            Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_create_page'), $idText);
            return $this->redirect(['view', 'id' => $model->page_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $idText = 'ID: '.$model->page_id;
            Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_update_page'), $idText);
            return $this->redirect(['view', 'id' => $model->page_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $idText = 'ID: '.$id;
        Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_deleted_page'), $idText);
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Pageadmin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'page_does_not_exists'));
        }
    }
}
