<?php
namespace app\controllers;
use Yii;
use app\models\Leftmenuadmin;
use app\models\Pageadmin;
use app\models\Newsadmin;
use app\models\Eventadmin;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class LeftmenuadminController extends Controller
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
        $model = new Leftmenuadmin();

        $WasAdded = false;
        $WasPoz = false;

        if(Yii::$app->request->post('setpozition') == 'yes')
        {
            Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'com_set_menu_poz'));

            if(!empty(Yii::$app->request->post('poz'))) {
                foreach(Yii::$app->request->post('poz') AS $Key=>$Value)
                {
                    $model->SetPozition($Key,$Value);
                }
            }
            $WasPoz = true;
        }

        if(Yii::$app->request->get('delete') != "")
        {
            Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'com_del_menu_element'));
            $model->DeleteMenu(Yii::$app->request->get('delete'));
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if($model->menu_what == 'pageone')
            {
                $Pages = Pageadmin::find()->where('page_id = :page_id', ['page_id' => $model->menu_content_id])->asArray()->one();
                $model->menu_extra = $Pages['page_url'];
            }


            if($model->menu_what == 'newsone')
            {
                $News = Newsadmin::find()->where('news_id = :news_id', ['news_id' => $model->menu_content_id])->asArray()->one();
                $model->menu_extra = $News['news_url'];
            }

            if($model->menu_what == 'eventone')
            {
                $Event = Eventadmin::find()->where('event_id = :event_id', ['event_id' => $model->menu_content_id])->asArray()->one();
                $model->menu_extra = $Event['event_url'];
            }

            Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'com_add_menu_element'));

            if($model->menu_extra == null)
            {
                $model->menu_extra = '';
            }

            $model->SaveData();

            $model->menu_id = "";
            $model->menu_title = "";
            $model->menu_poz = "";
            $model->menu_parent_id = "";
            $model->is_only_for_authorized = "";
            $model->menu_what = "";
            $model->menu_content_id = "";
            $model->menu_extra = "";

            $WasAdded = true;
        }

        $MainAllPages = Leftmenuadmin::find()
            ->where(['menu_parent_id' => 0])
            ->asArray()
            ->orderBy('menu_poz')
            ->all();

        $MainSubPages = Leftmenuadmin::find()
            ->where('menu_parent_id != 0')
            ->asArray()
            ->orderBy('menu_poz')
            ->all();

        $MainPages = Leftmenuadmin::find()
            ->where(['menu_what' => 'none'])
            ->asArray()
            ->orderBy('menu_poz')
            ->all();

        $MainsTable = array();

        for($p=0;$p<count($MainPages);$p++)
        {
            $MainsTable[$MainPages[$p]['menu_id']] = $MainPages[$p]['menu_title'];
        }

        $Pages = Pageadmin::find()
            ->asArray()
            ->orderBy('page_id')
            ->all();

        $PageTable = array();
        for($p=0;$p<count($Pages);$p++)
        {
            $PageTable[$Pages[$p]['page_id']] = $Pages[$p]['page_title'];
        }

        $Entries = Newsadmin::find()
            ->orderBy('news_id')
            ->asArray()
            ->all();

        $EntriesTable = array();
        for($p=0;$p<count($Entries);$p++)
        {
            $EntriesTable[$Entries[$p]['news_id']] = $Entries[$p]['news_title'];
        }

        $Event = Eventadmin::find()
            ->orderBy('event_id')
            ->asArray()
            ->all();

        $EventsTable = array();

        for($p=0;$p<count($Event);$p++)
        {
            $EventsTable[$Event[$p]['event_id']] = $Event[$p]['event_title'];
        }

        return $this->render('menu', ['model' => $model, 'EventsTable' => $EventsTable, 'WasPoz' => $WasPoz,
            'MainSubPages' => $MainSubPages, 'MainAllPages' => $MainAllPages, 'WasAdded' => $WasAdded, 'PageTable' =>
                $PageTable, 'EntriesTable' => $EntriesTable, 'MainsTable' =>
                $MainsTable]);
    }
}
