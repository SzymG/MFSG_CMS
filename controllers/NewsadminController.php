<?php
namespace app\controllers;
use app\helpers\UploadHelper;
use Yii;
use app\models\Newsadmin;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


class NewsadminController extends Controller
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

        Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_browse_news'));

        $dataProvider = new ActiveDataProvider([
            'query' => Newsadmin::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $idText = 'ID: '.$id;
        Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_browse_one_entry_news'), $idText);

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Newsadmin();
        $model->news_date = date('Y-m-d H:i:s');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->file_photo = UploadedFile::getInstance($model, 'news_photo_url');
            $nameSet = UploadHelper::generatePath($model->file_photo->extension);
            $model->news_photo_url = $nameSet['name'];
            if($model->save() && $model->upload($nameSet)) {
                $idText = 'ID: '.$model->news_id;
                Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_create_news'), $idText);
                return $this->redirect(['view', 'id' => $model->news_id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = new Newsadmin();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $uploadSuccess = true;

            if (!empty(UploadedFile::getInstance($model, 'news_photo_url'))) {
                $model->file_photo = UploadedFile::getInstance($model, 'news_photo_url');
                $nameSet = UploadHelper::generatePath($model->file_photo->extension);
                $model->unlinkPhoto($model->news_photo_url);
                $model->news_photo_url = $nameSet['name'];
                $uploadSuccess = $model->upload($nameSet);
            }

            if($uploadSuccess && $model->save()) {
                $idText = 'ID: '.$id;
                Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_news_updated'), $idText);
                return $this->redirect(['view', 'id' => $model->news_id]);
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
        if($model->news_photo_url) {
            $model->unlinkPhoto($model->news_photo_url);
        }
        $model->delete();
        $idText = 'ID: '.$id;
        Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_news_delete'), $idText);

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Newsadmin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'page_does_not_exists'));
        }
    }
}
