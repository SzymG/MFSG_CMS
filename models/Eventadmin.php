<?php
namespace app\models;
use app\helpers\UploadHelper;
use Yii;

class Eventadmin extends \yii\db\ActiveRecord
{

    public $file_photo;

    public static function tableName()
    {
        return '{{%event}}';
    }

    public function rules()
    {
        return [
            [['event_title', 'event_text', 'event_date', 'event_date_start', 'event_url'], 'required'],
            [['event_text'], 'string'],
            [['event_date_start', 'event_date_end', 'is_only_for_authorized', 'is_active'], 'safe'],
            ['event_date_end','compare','compareAttribute'=>'event_date_start','operator'=>'>'],
            [['event_title'], 'string', 'max' => 150],
            [['event_photo_url'], 'string', 'max' => 65],
            [['event_url'], 'string', 'max' => 65],
            [['is_only_for_authorized'], 'boolean'],
            [['is_active'], 'boolean'],
        ];
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

    public function upload($nameSet) {
        if(!$this->file_photo) {
            return true;
        }
        if ($this->validate()) {
            return $result = $this->file_photo->saveAs($nameSet['fullName']) ? $nameSet['fullName'] : null;
        } else {
            return false;
        }
    }

    public function unlinkPhoto($photo) {
        $fileToUnlink = UploadHelper::getUploadPath().'/'.$photo;
        if(file_exists($fileToUnlink)) {
            unlink(UploadHelper::getUploadPath().'/'.$photo);
        }
        return true;
    }
}
