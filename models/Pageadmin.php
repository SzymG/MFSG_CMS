<?php
namespace app\models;
use Yii;

class Pageadmin extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%page}}';
    }

    public function rules()
    {
        return [
            [['page_title', 'page_text', 'page_url'], 'required'],
            [['page_text'], 'string'],
            [['page_title', 'page_url'], 'string', 'max' => 150],
            [['is_only_for_authorized'], 'boolean'],
            [['is_active'], 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'page_id' => Yii::t('app', 'page_id'),
            'page_title' => Yii::t('app', 'page_title'),
            'page_text' => Yii::t('app', 'page_text'),
            'is_only_for_authorized' => Yii::t('app', 'is_only_for_authorized'),
            'is_active' => Yii::t('app', 'is_active'),
            'page_url' => Yii::t('app', 'page_url'),
        ];
    }

}
