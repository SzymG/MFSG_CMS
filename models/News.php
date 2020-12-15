<?php
namespace app\models;
use Yii;
use yii\base\Model;

class News extends Model
{
    public $news_id;
    public $news_title;
    public $news_text;
    public $news_date;
    public $news_url;
    public $is_only_for_authorized;
    public $is_active;
    public $news_photo_url;

    public static function tableName()
    {
        return '{{%news}}';
    }

    public function CountAll()
    {
        $query = Yii::$app->db->createCommand('SELECT count(news_id) AS HowManyRecords FROM {{%news}} WHERE is_active = 1 ');
        $session = Yii::$app->session;
        if($session['yii_user_id'] == "") {
            $query = Yii::$app->db->createCommand('SELECT count(news_id) AS HowManyRecords FROM {{%news}} WHERE is_active = 1 AND is_only_for_authorized = 0');
        }

        $QueryData = $query->queryScalar();
        $ToReturn = 0;

        if($QueryData != false)
        {
            $ToReturn = $QueryData;
        }

        return $ToReturn;
    }

    public function SelectNews($Start,$Limit)
    {
        $query = Yii::$app->db->createCommand('SELECT * FROM {{%news}} WHERE is_active = 1 ORDER BY news_id DESC LIMIT
            :start,:limit');

        $session = Yii::$app->session;
        if($session['yii_user_id'] == "") {
            $query = Yii::$app->db->createCommand('SELECT * FROM {{%news}} WHERE is_active = 1 AND is_only_for_authorized = 0 ORDER BY news_id DESC LIMIT
            :start,:limit');
        }

        $QueryData = $query
            ->bindParam(':start', $Start)
            ->bindParam(':limit', $Limit)
            ->queryAll();

        return $QueryData;
    }
    public function SelectOneNews($NewsId)
    {
        $query = Yii::$app->db->createCommand('SELECT * FROM {{%news}} WHERE news_id = :news_id AND is_active = 1');

        $session = Yii::$app->session;
        if($session['yii_user_id'] == "") {
            $query = Yii::$app->db->createCommand('SELECT * FROM {{%news}} WHERE news_id = :news_id AND is_active = 1 AND is_only_for_authorized = 0');
        }

        $query->bindParam(':news_id', $NewsId);
        $QueryData = $query->queryOne();

        if($QueryData == false)
        {
            $ToReturn = false;
        }
        else
        {
            $ToReturn = true;
            $this->news_id = $QueryData['news_id'];
            $this->news_title = $QueryData['news_title'];
            $this->news_text = $QueryData['news_text'];
            $this->news_date = $QueryData['news_date'];
            $this->news_url = $QueryData['news_url'];
            $this->is_only_for_authorized = $QueryData['is_only_for_authorized'];
            $this->is_active = $QueryData['is_active'];
            $this->news_photo_url = $QueryData['news_photo_url'];
        }

        return $ToReturn;

    }

    public function attributeLabels()
    {
        return [
            'news_id' => Yii::t('app', 'news_id'),
            'news_title' => Yii::t('app', 'news_title'),
            'news_text' => Yii::t('app', 'news_text'),
            'news_date' => Yii::t('app', 'news_date'),
            'news_url' => Yii::t('app', 'news_url'),
            'is_only_for_authorized' => Yii::t('app', 'is_only_for_authorized'),
            'is_active' => Yii::t('app', 'is_active'),
            'news_photo_url' => Yii::t('app', 'news_photo_url'),
        ];
    }

}
