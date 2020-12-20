<?php
namespace app\models;
use Yii;
use yii\base\Model;

class User extends Model {
    public $user_id;
    public $user_email;
    public $user_password;
    public $user_password2;
    public $user_password3;
    public $user_key;
    public $user_register;
    public $user_registered_ip;
    public $user_active;
    public $user_activated;
    public $user_activated_ip;
    public $user_root;
    public $user_namesurname;
    public $user_phone;
    public $user_about;
    public $user_captcha;
    public $captcha;
    public $password_hash1;
    public $password_hash2;

    public static function tableName() {
        return 'user';
    }

    const SCENARIO_LOGIN = 'login';
    const SCENARIO_REGISTER = 'register';
    const SCENARIO_CHANGEPASSWORD = 'changepassword';
    const SCENARIO_UPDATEPROFILE = 'updateprofile';
    const SCENARIO_ACTIVATE = 'activate';
    const SCENARIO_REMIND = 'remind';

    public function scenarios() {
        return [
            self::SCENARIO_LOGIN => ['user_email', 'user_password'],
            self::SCENARIO_REGISTER => ['user_email', 'user_password', 'user_password2',
                'user_namesurname', 'user_phone', 'user_about'],
            self::SCENARIO_CHANGEPASSWORD => ['user_password', 'user_password2', 'user_password3'],
            self::SCENARIO_UPDATEPROFILE => [ 'user_namesurname', 'user_phone', 'user_about'],
            self::SCENARIO_ACTIVATE => ['user_id'],
            self::SCENARIO_REMIND => ['user_email', 'user_captcha']
        ];
    }

    public function rules()
    {
        return [
            [['user_email', 'user_password'], 'required', 'on' => self::SCENARIO_LOGIN],
            [['user_email'], 'email', 'on' => self::SCENARIO_LOGIN],
            [['user_email'], 'validateUserName', 'skipOnError' => false, 'on' => self::SCENARIO_LOGIN],
            [['user_password', 'user_password2', 'user_password3'], 'required', 'on' =>
                self::SCENARIO_CHANGEPASSWORD],
            [['user_password2', 'user_password3'], 'string', 'length' => [8, 30], 'on' =>
                self::SCENARIO_CHANGEPASSWORD],
            [['user_password2'], 'match', 'pattern' => '/^.*(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/', 'message' =>
                Yii::t('app', 'new_password_need_to_have'), 'on' => self::SCENARIO_CHANGEPASSWORD],
            [['user_password2'], 'compare', 'compareAttribute' => 'user_password3', 'on' =>
                self::SCENARIO_CHANGEPASSWORD],
            ['user_password', 'validateUserPassword', 'skipOnError' => false, 'on' => self::SCENARIO_CHANGEPASSWORD],
            [['user_email', 'user_password', 'user_password2'], 'required', 'on' => self::SCENARIO_REGISTER],
            ['user_email', 'email', 'on' => self::SCENARIO_REGISTER],
            [['user_password', 'user_password2'], 'string', 'length' => [8, 30], 'on' => self::SCENARIO_REGISTER],
            [['user_password'], 'match', 'pattern' => '/^.*(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/', 'message' =>
                Yii::t('app', 'new_password_need_to_have'), 'on' => self::SCENARIO_REGISTER],
            ['user_password', 'compare', 'compareAttribute' => 'user_password2', 'on' => self::SCENARIO_REGISTER],
            ['user_email', 'validateUserIsEmail', 'skipOnError' => false, 'on' => self::SCENARIO_REGISTER],
            [['user_captcha', 'user_email'], 'required', 'on' => self::SCENARIO_REMIND],
            ['user_email', 'email', 'on' => self::SCENARIO_REMIND],
            ['user_captcha', 'captcha', 'captchaAction' => 'user/captcha', 'on' => self::SCENARIO_REMIND],
            ['user_email', 'validateUserRemind', 'skipOnError' => false, 'on' => self::SCENARIO_REMIND],
        ];
    }

    public function ActivateUser($UserId,$UserKey) {
        $QueryData = Yii::$app->db->createCommand('SELECT user_id,user_key,user_active FROM {{%user}} WHERE user_id = :user_id AND user_active = 0')
            ->bindParam(':user_id', $UserId)
            ->queryOne();

        if($QueryData == false)
        {
            $ToReturn = false;
        }
        else
        {
            $NowDate = date('Y-m-d H:i:s');
            $IpOfUser = $_SERVER['REMOTE_ADDR'];
            Yii::$app->db->createCommand('UPDATE {{%user}} SET
                user_active = 1,
                user_activated = :user_activated,
                user_activated_ip = :user_activated_ip
                WHERE
                user_id = :user_id
                AND
                user_key = :user_key
                ')
                ->bindParam(':user_id', $UserId)
                ->bindParam(':user_activated', $NowDate)
                ->bindParam(':user_activated_ip', $IpOfUser)
                ->bindParam(':user_key', $UserKey)
                ->execute();

            $ToReturn = true;
        }

        return $ToReturn;
    }

    public function RegisterUser() {
        $Salt = Yii::$app->params['saltPassword'];
        $UserPassword = password_hash($this->user_password.$Salt, PASSWORD_DEFAULT);

        $UserKey = strtolower(Yii::$app->getSecurity()->generateRandomString(20));
        $UserRegisterDate = date('Y-m-d H:i:s');
        $UserRegisterIp = $_SERVER['REMOTE_ADDR'];

        $nameSurname = htmlspecialchars($this->user_namesurname);
        $userPhone = htmlspecialchars($this->user_phone);
        $userAbout = htmlspecialchars($this->user_about);

        $userActive = 0;
        $userRoot = 0;

        $QueryData = Yii::$app->db->createCommand('INSERT INTO {{%user}}
        (user_email,user_password,user_key,user_register,user_registered_ip,user_namesurname,user_phone,user_about, user_active, user_root)
        values
        (:user_email,:user_password,:user_key,:user_register,:user_registered_ip,:user_namesurname,:user_phone,:user_about, :user_active, :user_root)
        ')
            ->bindParam(':user_namesurname', $nameSurname)
            ->bindParam(':user_phone', $userPhone)
            ->bindParam(':user_about', $userAbout)
            ->bindParam(':user_email', $this->user_email)
            ->bindParam(':user_password', $UserPassword)
            ->bindParam(':user_key', $UserKey)
            ->bindParam(':user_register', $UserRegisterDate)
            ->bindParam(':user_registered_ip', $UserRegisterIp)
            ->bindParam(':user_active', $userActive)
            ->bindParam(':user_root', $userRoot)
            ->execute();

        $QueryData = Yii::$app->db->createCommand('SELECT user_id,user_key FROM {{%user}} WHERE user_email = :user_email')
            ->bindParam(':user_email', $this->user_email)->queryOne();
        return $QueryData;
    }

    public function SelectProfile() {
        $session = Yii::$app->session;
        $UserId = $session['yii_user_id'];
        $QueryData = Yii::$app->db->createCommand('SELECT
            user_id,user_email,user_namesurname,user_phone,user_about,user_register,user_registered_ip,user_active,
            user_activated,user_activated_ip,user_root FROM {{%user}} WHERE user_id = :user_id')
            ->bindParam(':user_id', $UserId)->queryOne();

        if($QueryData != false)
        {
            $ProfileData = $QueryData;
        }

        return $ProfileData;
    }

    public function UpdateProfile() {
        $session = Yii::$app->session;
        $UserId = $session['yii_user_id'];
        $nameSurname = htmlspecialchars($this->user_namesurname);
        $userPhone = htmlspecialchars($this->user_phone);
        $userAbout = htmlspecialchars($this->user_about);

        $QueryData = Yii::$app->db->createCommand('UPDATE {{%user}} SET user_namesurname = :user_namesurname,
            user_phone = :user_phone, user_about = :user_about
            WHERE
            user_id = :user_id')
            ->bindParam(':user_namesurname', $nameSurname)
            ->bindParam(':user_phone', $userPhone)
            ->bindParam(':user_about', $userAbout)
            ->bindParam(':user_id', $UserId)->execute();
    }

    public function SetNewPassword($UserId,$UserHash1,$UserHash2) {
        $QueryDataIs = Yii::$app->db->createCommand('SELECT * FROM {{%user}} WHERE
            user_id = :user_id
            AND
            user_password_hash1 = :user_password_hash1
            AND
            user_password_hash2 = :user_password_hash2
            ')
            ->bindParam(':user_id', $UserId)
            ->bindParam(':user_password_hash1', $UserHash1)
            ->bindParam(':user_password_hash2', $UserHash2)
            ->queryOne();

        // Sprawdzamy czy użytkownik istnieje

        if($QueryDataIs != false) {
            $DateAndTimePlus = date('Y-m-d H:i:s', strtotime('-2 hours',time()));
            $QueryData = Yii::$app->db->createCommand('SELECT * FROM {{%user}} WHERE
                user_id = :user_id
                AND
                user_password_hash1 = :user_password_hash1
                AND
                user_password_hash2 = :user_password_hash2
                AND
                user_password_time > :user_password_time
                ')
                ->bindParam(':user_id', $UserId)
                ->bindParam(':user_password_hash1', $UserHash1)
                ->bindParam(':user_password_hash2', $UserHash2)
                ->bindParam(':user_password_time', $DateAndTimePlus)
                ->queryOne();

            $ReturnedValue = false;

            if($QueryData != false) {
                $QueryDataUser = Yii::$app->db->createCommand('SELECT user_id,user_email FROM {{%user}} WHERE user_id =
                    :user_id')
                    ->bindParam(':user_id', $UserId)->queryOne();
                $this->user_email = $QueryDataUser['user_email'];

                $TemporaryPasword = strtolower(Yii::$app->getSecurity()->generateRandomString(20));
                $Salt = Yii::$app->params['saltPassword'];
                $ReadyPassword = password_hash($TemporaryPasword.$Salt, PASSWORD_DEFAULT);
                $this->user_password = $TemporaryPasword;

                Yii::$app->db->createCommand('UPDATE {{%user}} SET user_password = :user_password WHERE user_id =
                    :user_id')
                    ->bindParam(':user_password', $ReadyPassword)
                    ->bindParam(':user_id', $UserId)->execute();

                $ReturnedValue = true;
            }
        }
        else
        {
            $ReturnedValue = false;
        }

        return $ReturnedValue;
    }

    public function validateUserRemind($attribute, $params, $validator) {
        $QueryData = Yii::$app->db->createCommand('SELECT user_id FROM {{%user}} WHERE user_email = :user_email
            AND user_active = 1')
            ->bindParam(':user_email', $this->user_email)->queryOne();

        if($QueryData == false)
        {
            $this->addError($attribute, Yii::t('app', 'account_dont_exists'));
        }
        else
        {
            $UserId = $QueryData['user_id'];
            $DateTimeSet = date("Y-m-d H:i:s");
            $Hash1 = strtolower(Yii::$app->getSecurity()->generateRandomString(20));
            $Hash2 = strtolower(Yii::$app->getSecurity()->generateRandomString(20));

            Yii::$app->db->createCommand('UPDATE {{%user}} SET user_password_hash1 = :user_password_hash1, user_password_hash2 = :user_password_hash2,
            user_password_time = :user_password_time
            WHERE
            user_id = :user_id')
                ->bindParam(':user_password_hash1', $Hash1)
                ->bindParam(':user_password_hash2', $Hash2)
                ->bindParam(':user_password_time', $DateTimeSet)
                ->bindParam(':user_id', $UserId)->execute();

            $this->password_hash1 = $Hash1;
            $this->password_hash2 = $Hash2;
            $this->user_id = $UserId;
        }
    }

    public function validateUserIsEmail($attribute, $params, $validator)
    {
        $QueryData = Yii::$app->db->createCommand('SELECT * FROM {{%user}} WHERE user_email = :user_email')
            ->bindParam(':user_email', $this->user_email)->queryOne();

        if($QueryData != false)
        {
            $this->addError($attribute, Yii::t('app', 'account_email_is_registered'));
        }

    }

    public function validateUserPassword($attribute, $params, $validator)
    {
        $session = Yii::$app->session;
        $UserId = $session['yii_user_id'];

        $QueryData = Yii::$app->db->createCommand('SELECT * FROM {{%user}} WHERE user_id = :user_id')
            ->bindParam(':user_id', $UserId)->queryOne();

        if($QueryData != false)
        {
            $Salt = Yii::$app->params['saltPassword'];

            if(!password_verify($this->user_password.$Salt,$QueryData['user_password'])) {
                $this->addError($attribute, Yii::t('app', 'password_dont_match'));
            }
        }
    }

    public function validateUserName($attribute, $params, $validator)
    {
        $QueryData = Yii::$app->db->createCommand('SELECT * FROM {{%user}} WHERE user_email = :user_email')
            ->bindParam(':user_email', $this->user_email)->queryOne();

        if($QueryData == false)
        {
            $this->addError($attribute, Yii::t('app', 'no_user_with_email'));
        }
        else
        {
            if($QueryData['user_active'] == 1)
            {
                $Salt = Yii::$app->params['saltPassword'];
                if(password_verify($this->user_password.$Salt,$QueryData['user_password']))
                {
                    $session = Yii::$app->session;
                    $session['yii_user_id'] = $QueryData['user_id'];
                    $session['yii_user_email'] = $QueryData['user_email'];
                    $session['yii_user_root'] = $QueryData['user_root'];
                }
                else
                {
                    $this->addError($attribute, Yii::t('app', 'password_dont_match'));
                }
            }
            else {
                $this->addError($attribute, Yii::t('app', 'user_account_not_active'));
            }
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
