<?php
namespace app\models;
use Yii;

class Logadmin extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%log}}';
    }

    public function rules()
    {
        return [
            [['log_user_id', 'log_what', 'log_time', 'log_ip'], 'required'],
            [['log_user_id'], 'integer'],
            [['log_time', 'log_message'], 'safe'],
            [['log_what'], 'string', 'max' => 50],
            [['log_message'], 'string', 'max' => 512],
            [['log_ip'], 'string', 'max' => 15],
        ];
    }

    public function SelectUser($UserId)
    {
        $QueryDataIs = Yii::$app->db->createCommand('SELECT user_email FROM {{%user}} WHERE user_id = :user_id')
            ->bindParam(':user_id', $UserId)
            ->queryOne();

        if($QueryDataIs['user_email'] == "")
        {
            $ToReturn = '[no user]';
        }
        else
        {
            $ToReturn = $QueryDataIs['user_email'];
        }

        return $ToReturn;
    }

    public function attributeLabels()
    {
        return [
            'log_id' => Yii::t('app', 'log_id'),
            'log_user_id' => Yii::t('app', 'log_user_id'),
            'log_what' => Yii::t('app', 'log_what'),
            'log_message' => Yii::t('app', 'log_message'),
            'log_time' => Yii::t('app', 'log_time'),
            'log_ip' => Yii::t('app', 'log_ip'),
        ];
    }
}
