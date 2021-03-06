<?php
namespace app\models;
use Yii;
use yii\base\Model;

class Event extends Model
{
    public $event_id;
    public $event_title;
    public $event_text;
    public $event_date;
    public $event_date_start;
    public $event_date_end;
    public $event_photo_url;
    public $is_only_for_authorized;
    public $is_active;
    public $event_url;

    public static function tableName()
    {
        return '{{%event}}';
    }

    public function CountAll() {
        $query = Yii::$app->db->createCommand('SELECT count(event_id) AS HowManyRecords FROM {{%event}} WHERE is_active = 1 ');
        $session = Yii::$app->session;
        if($session['yii_user_id'] == "") {
            $query = Yii::$app->db->createCommand('SELECT count(event_id) AS HowManyRecords FROM {{%event}} WHERE is_active = 1 AND is_only_for_authorized = 0');
        }

        $QueryData = $query->queryScalar();
        $ToReturn = 0;

        if($QueryData != false)
        {
            $ToReturn = $QueryData;
        }

        return $ToReturn;
    }

    public function SelectEvents($Start,$Limit)
    {
        $query = Yii::$app->db->createCommand('SELECT * FROM {{%event}} WHERE is_active = 1 ORDER BY event_id DESC LIMIT
            :start,:limit');

        $session = Yii::$app->session;
        if($session['yii_user_id'] == "") {
            $query = Yii::$app->db->createCommand('SELECT * FROM {{%event}} WHERE is_active = 1 AND is_only_for_authorized = 0 ORDER BY event_id DESC LIMIT
            :start,:limit');
        }

        $QueryData = $query
            ->bindParam(':start', $Start)
            ->bindParam(':limit', $Limit)
            ->queryAll();

        return $QueryData;
    }

    public function SelectOneEvent($EventId)
    {
        $query = Yii::$app->db->createCommand('SELECT * FROM {{%event}} WHERE event_id = :event_id AND is_active = 1');

        $session = Yii::$app->session;
        if($session['yii_user_id'] == "") {
            $query = Yii::$app->db->createCommand('SELECT * FROM {{%event}} WHERE event_id = :event_id AND is_active = 1 AND is_only_for_authorized = 0');
        }

        $query->bindParam(':event_id', $EventId);
        $QueryData = $query->queryOne();

        if($QueryData == false)
        {
            $ToReturn = false;
        }
        else
        {
            $ToReturn = true;

            $this->event_id = $QueryData['event_id'];
            $this->event_title = $QueryData['event_title'];
            $this->event_text = $QueryData['event_text'];
            $this->event_date = $QueryData['event_date'];
            $this->event_date_start = $QueryData['event_date_start'];
            $this->event_date_end = $QueryData['event_date_end'];
            $this->event_photo_url = $QueryData['event_photo_url'];
            $this->is_only_for_authorized = $QueryData['is_only_for_authorized'];
            $this->is_active = $QueryData['is_active'];
            $this->event_url = $QueryData['event_url'];
        }

        return $ToReturn;
    }

    public function attributeLabels()
    {
        return [
            'event_id' => Yii::t('app', 'event_id'),
            'event_title' => Yii::t('app', 'event_title'),
            'event_text' => Yii::t('app', 'event_text'),
            'event_date' => Yii::t('app', 'event_date'),
            'event_date_start' => Yii::t('app', 'event_date_start'),
            'event_date_end' => Yii::t('app', 'event_date_end'),
            'event_photo_url' => Yii::t('app', 'event_photo_url'),
            'event_url' => Yii::t('app', 'event_url'),
            'is_only_for_authorized' => Yii::t('app', 'is_only_for_authorized'),
            'is_active' => Yii::t('app', 'is_active'),
        ];
    }
}
