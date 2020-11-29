<?php
namespace app\models;
use Yii;

class Newsadmin extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%news}}';
    }

    public function rules()
    {
        return [
            [['news_title', 'news_text', 'news_date', 'news_url'], 'required'],
            [['news_text'], 'string'],
            [['news_date'], 'safe'],
            [['news_title'], 'string', 'max' => 150],
            [['news_photo_url'], 'string', 'max' => 65],
            [['news_url'], 'string', 'max' => 65],
            [['is_only_for_authorized'], 'boolean'],
        ];
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
            'news_photo_url' => Yii::t('app', 'news_photo_url'),
        ];
    }

}
