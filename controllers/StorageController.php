<?php
namespace app\controllers;

use app\helpers\UploadHelper;
use Yii;
use yii\web\BadRequestHttpException;
use yii\helpers\FileHelper;
use yii\filters\AccessControl;


use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Storage controller
 */
class StorageController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true
                    ],
                ],
            ],
        ];
    }

    public function actionIndex($f) {
        $originalKey = $f;
        $f = FileHelper::normalizePath(UploadHelper::getUploadPath().'/'.$f);

        if(!file_exists($f)) {
            throw new BadRequestHttpException(Yii::t('app', 'errorBadRequest'));
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;

        header('Content-Type: ' . mime_content_type($f));
        if(!empty($originalKey)) {
            header('Content-Disposition: inline; filename="'.$originalKey.'"');
        }
        return file_get_contents($f);
    }


}
