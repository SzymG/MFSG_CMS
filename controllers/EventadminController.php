<?php
namespace app\controllers;
use app\helpers\UploadHelper;
use Yii;
use app\models\Eventadmin;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


class EventadminController extends Controller
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
//        Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_browse_events'));
        $dataProvider = new ActiveDataProvider([
            'query' => Eventadmin::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $idText = 'ID: '.$id;
//        Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_browse_one_event'), $idText);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate() {
        $model = new Eventadmin();
        $model->event_date = date('Y-m-d H:i:s');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if(!empty(UploadedFile::getInstance($model, 'event_photo_url'))) {
                $model->file_photo = UploadedFile::getInstance($model, 'event_photo_url');
                $nameSet = UploadHelper::generatePath($model->file_photo->extension);
                $model->event_photo_url = $nameSet['name'];
                if($model->save() && $model->upload($nameSet)) {
                    $idText = 'ID: ' . $model->event_id;
                    Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_create_event'), $idText);
                    return $this->redirect(['view', 'id' => $model->event_id]);
                }
            }
            else {
                if($model->save()) {
                    $idText = 'ID: ' . $model->event_id;
                    Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_create_event'), $idText);
                    return $this->redirect(['view', 'id' => $model->event_id]);
                }
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $uploadSuccess = true;

            if (!empty(UploadedFile::getInstance($model, 'event_photo_url'))) {
                $model->file_photo = UploadedFile::getInstance($model, 'event_photo_url');
                $nameSet = UploadHelper::generatePath($model->file_photo->extension);
                $model->unlinkPhoto($model->event_photo_url);
                $model->event_photo_url = $nameSet['name'];
                $uploadSuccess = $model->upload($nameSet);
            }

            if($uploadSuccess && $model->save()) {
                $idText = 'ID: '.$id;
                Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_update_event'), $idText);
                return $this->redirect(['view', 'id' => $model->event_id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model->event_photo_url) {
            $model->unlinkPhoto($model->event_photo_url);
        }
        $model->delete();
        $idText = 'ID: '.$id;

        Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_deleted_event'), $idText);

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Eventadmin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'page_does_not_exists'));
        }
    }
}
