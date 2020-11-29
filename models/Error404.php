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

    public function AddError404($FromPage,$OnPage)
    {
        $FromPage = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'null';
        $OnPage = (isset($_SERVER['HTTPS']) ? "https" : "http")."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $DateError = date("y-m-d H:i:s");

        $QueryData = Yii::$app->db->createCommand('INSERT INTO {{%error404}} (error_page_from, error_page,
            error_date)
            values
            (:error_page_from, :error_page, :error_date)
            ')
            ->bindParam(':error_page_from', $FromPage)
            ->bindParam(':error_page', $OnPage)
            ->bindParam(':error_date', $DateError)
            ->execute();
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
