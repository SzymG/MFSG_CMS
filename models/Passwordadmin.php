<?php
namespace app\models;
use Yii;

class Passwordadmin extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%password}}';
    }

    public function rules()
    {
        return [
            [['password_user_id', 'password_hash1', 'password_hash2', 'password_time', 'password_time_used',
                'password_ip', 'password_used'], 'required'],
            [['password_user_id'], 'integer'],
            [['password_time', 'password_time_used'], 'safe'],
            [['password_hash1', 'password_hash2'], 'string', 'max' => 20],
            [['password_ip'], 'string', 'max' => 15],
            [['password_used'], 'string', 'max' => 1],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password_id' => Yii::t('app', 'password_id'),
            'password_user_id' => Yii::t('app', 'password_user_id'),
            'password_hash1' => Yii::t('app', 'password_hash1'),
            'password_hash2' => Yii::t('app', 'password_hash2'),
            'password_time' => Yii::t('app', 'password_time'),
            'password_time_used' => Yii::t('app', 'password_time_used'),
            'password_ip' => Yii::t('app', 'password_ip'),
            'password_used' => Yii::t('app', 'password_used'),
        ];
    }
}
