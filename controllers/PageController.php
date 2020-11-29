<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Page;
use yii\data\Pagination;

class PageController extends Controller {
    // TODO wyrzucanie ze strony, jeśli jest przeznaczona tylko dla zalogownych
    public function actionIndex() {
        $model = new Page();
        $CountAll = $model->CountAll();
        $pagination = new Pagination(['totalCount' => $CountAll, 'pageSize' => 10]);
        $SelectPages = $model->SelectPages($pagination->offset,$pagination->limit);
        return $this->render('page', ['model' => $model, 'SelectPages' => $SelectPages, 'pagination' =>
            $pagination]);
    }

    public function actionShowone($PageUrl,$PageId) {
        $model = new Page();
        $IsThatPage = $model->SelectOnePage($PageId);
        if($IsThatPage)
        {
            return $this->render('showone', ['model' => $model]);
        }
        else
        {
            return $this->render('page-noexists', ['model' => $model]);
        }
    }

    public function actionHome() {
        $model = new Page();
        $IsThatPage = $model->SelectHome();
        if($IsThatPage)
        {
            return $this->render('showhome', ['model' => $model]);
        }
        else
        {
            return $this->render('page-noexists', ['model' => $model]);
        }
    }
}
