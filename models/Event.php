<?php
namespace app\models;
use Yii;
use yii\base\Model;

class Event extends Model
{
    public $event_id;
    public $event_title;
    public $event_text;
    public $event_author;
    public $event_date_start;
    public $event_date_end;
    public $event_photo_url;
    public $is_only_for_authorized;
    public $event_url;

    public static function tableName()
    {
        return '{{%event}}';
    }

    public function CountAll() {
        $QueryData = Yii::$app->db->createCommand('SELECT count(event_id) AS HowManyRecords FROM {{%event}}')
            ->queryScalar();

        $ToReturn = 0;

        if($QueryData != false)
        {
            $ToReturn = $QueryData;
        }

        return $ToReturn;
    }

    public function SelectEvents($Start,$Limit)
    {
        $QueryData = Yii::$app->db->createCommand('SELECT * FROM {{%event}} ORDER BY event_id DESC LIMIT
            :start,:limit')
            ->bindParam(':start', $Start)
            ->bindParam(':limit', $Limit)
            ->queryAll();

        return $QueryData;
    }

    public function SelectOneEvent($EventId)
    {
        $QueryData = Yii::$app->db->createCommand('SELECT * FROM {{%event}} WHERE event_id = :event_id')
            ->bindParam(':event_id', $EventId)
            ->queryOne();

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
            $this->event_author = $QueryData['event_author'];
            $this->event_date_start = $QueryData['event_date_start'];
            $this->event_date_end = $QueryData['event_date_end'];
            $this->event_photo_url = $QueryData['event_photo_url'];
            $this->is_only_for_authorized = $QueryData['is_only_for_authorized'];
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
            'event_author' => Yii::t('app', 'event_author'),
            'event_date_start' => Yii::t('app', 'event_date_start'),
            'event_date_end' => Yii::t('app', 'event_date_end'),
            'event_photo_url' => Yii::t('app', 'event_photo_url'),
            'event_url' => Yii::t('app', 'event_url'),
            'is_only_for_authorized' => Yii::t('app', 'is_only_for_authorized'),
        ];
    }
}
