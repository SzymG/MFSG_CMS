<?php
namespace app\models;
use Yii;

class Error404 extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%error404}}';
    }

    public function rules()
    {
        return [
            [['error_page_from', 'error_page', 'error_date'], 'required'],
            [['error_page_from', 'error_page'], 'string'],
            [['error_date'], 'safe'],
        ];
    }

    public function AddError404()
    {
        $FromPage = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'null';
        $OnPage = (isset($_SERVER['HTTPS']) ? "https" : "http")."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $message = Yii::t('app', 'from').': '.$FromPage.', '.Yii::t('app', 'to').': '.$OnPage;
        Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_error404'), $message);
    }

    public function attributeLabels()
    {
        return [
            'error_id' => Yii::t('app', 'error_id'),
            'error_page_from' => Yii::t('app', 'error_page_from'),
            'error_page' => Yii::t('app', 'error_page'),
            'error_date' => Yii::t('app', 'error_date'),
        ];
    }

}
