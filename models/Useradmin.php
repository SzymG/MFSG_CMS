<?php
namespace app\models;
use Yii;

class Useradmin extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%user}}';
    }

    const SCENARIO_NEW = 'new';
    const SCENARIO_EDIT = 'edit';

    public function scenarios()
    {
        return [
            self::SCENARIO_NEW => ['user_email', 'user_namesurname', 'user_phone', 'user_about',
                'user_root'],
            self::SCENARIO_EDIT => ['user_namesurname', 'user_phone', 'user_about', 'user_root'],
        ];
    }

    public function rules()
    {
        return [
            [['user_email', 'user_namesurname'], 'required', 'on' => self::SCENARIO_NEW],
            ['user_email', 'email', 'on' => self::SCENARIO_NEW],
            ['user_email', 'validateUserIsEmail', 'skipOnError' => false, 'on' => self::SCENARIO_NEW],
            ['user_namesurname', 'required', 'on' => self::SCENARIO_EDIT],
        ];
    }

    public function validateUserIsEmail($attribute, $params, $validator)
    {
        $UserEmail = $this->user_email;
        $QueryData = Yii::$app->db->createCommand('SELECT * FROM {{%user}} WHERE user_email = :user_email')
            ->bindParam(':user_email', $UserEmail)->queryOne();

        if($QueryData != false) {
            $this->addError($attribute, Yii::t('app', 'a2_account_exist_email'));
        }

    }

    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'user_id'),
            'user_email' => Yii::t('app', 'user_email'),
            'user_password' => Yii::t('app', 'user_password'),
            'user_password2' => Yii::t('app', 'user_password2'),
            'user_password3' => Yii::t('app', 'user_password3'),
            'user_key' => Yii::t('app', 'user_key'),
            'user_register' => Yii::t('app', 'user_register'),
            'user_registered_ip' => Yii::t('app', 'user_registered_ip'),
            'user_active' => Yii::t('app', 'user_active'),
            'user_activated' => Yii::t('app', 'user_activated'),
            'user_activated_ip' => Yii::t('app', 'user_activated_ip'),
            'user_root' => Yii::t('app', 'user_root'),
            'user_namesurname' => Yii::t('app', 'user_namesurname'),
            'user_phone' => Yii::t('app', 'user_phone'),
            'user_about' => Yii::t('app', 'user_about'),
            'user_captcha' => Yii::t('app', 'user_captcha'),
        ];
    }
}
