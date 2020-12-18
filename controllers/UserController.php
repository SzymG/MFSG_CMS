<?php
namespace app\controllers;

use app\helpers\MailHelper;
use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\Error404;

class UserController extends Controller {
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionError()
    {
        $model = new Error404();
        $model->AddError404();
        return $this->render('error');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        $session = Yii::$app->session;
        if($session['yii_user_id'] == "") {
            $model = new User(['scenario' => User::SCENARIO_LOGIN]);

            if ($model->load(Yii::$app->request->post()) && $model->validate())
            {
                Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_login'));
                $this->goHome();
            }
            else
            {
                return $this->render('login', ['model' => $model]);
            }
        }
        else
        {
            $this->goHome();
        }
    }

    public function actionLogout()
    {
        Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_logout'));

        $session = Yii::$app->session;
        $session['yii_user_id'] = '';
        $session['yii_user_email'] = '';
        $session['yii_user_root'] = '';
        $this->goHome();
    }

    public function actionRempass()
    {
        $model = new User(['scenario' => User::SCENARIO_REMIND]);

        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $success = true;

                $UserRegisterIp = $_SERVER['REMOTE_ADDR'];
                $address = $model->user_email;
                $subject = Yii::t('app', 'user_remind_pass_title').Yii::$app->params['pageTitle'];
                $content = Yii::t('app', 'user_remind_pass_body', [
                    'page_title' => Yii::$app->params['pageTitle'],
                    'user_ip' => $UserRegisterIp,
                    'administrator' => Yii::$app->params['adminName'],
                    'page_link' => Yii::$app->params['pageUrl'].'remind-password-set/'.$model->user_id.'/'.$model->password_hash1.'/'.$model->password_hash2
                ]);

                (new MailHelper())->send($address, $subject, $content);
                $transaction->commit();
            } catch (\Exception $e) {
                $success = false;
                $transaction->rollBack();
            }

            return $this->render('rempass-success', ['model' => $model, 'success' => $success]);
        }
        else
        {
            return $this->render('rempass', ['model' => $model]);
        }
    }

    public function actionRempassset($UserId,$UserHash1,$UserHash2)
    {
        $model = new User();
        $model->SetNewPassword($UserId,$UserHash1,$UserHash2);
        $ReturnRemPass = $model->user_password;

        $ViewPassChanged = false;
        if($ReturnRemPass)
        {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $ViewPassChanged = true;

                $UserRegisterIp = $_SERVER['REMOTE_ADDR'];
                $address = $model->user_email;
                $subject = Yii::t('app', 'user_new_password').Yii::$app->params['pageTitle'];
                $content = Yii::t('app', 'user_new_password_body', [
                        'page_title' => Yii::$app->params['pageTitle'],
                        'user_ip' => $UserRegisterIp,
                        'administrator' => Yii::$app->params['adminName'],
                        'user_password' => $ReturnRemPass,
                    ]
                );

                (new MailHelper())->send($address, $subject, $content);
                $transaction->commit();
            } catch (\Exception $e) {
                $ViewPassChanged = false;
                $transaction->rollBack();
            }
        }

        return $this->render('rempass-set', ['model' => $model, 'ViewPassChanged' => $ViewPassChanged]);
    }

    public function actionActivate($UserId,$UserKey)
    {
        $model = new User(['scenario' => User::SCENARIO_ACTIVATE]);

        $MessageGood = $model->ActivateUser($UserId,$UserKey);

        return $this->render('activate', ['model' => $model, 'MessageGood' => $MessageGood]);
    }

    public function actionRegister()
    {
        $model = new User(['scenario' => User::SCENARIO_REGISTER]);

        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $success = true;
                $UserData = $model->RegisterUser();

                $UserRegisterIp = $_SERVER['REMOTE_ADDR'];
                $address = $model->user_email;
                $subject = Yii::t('app', 'user_actvate_account').' '.Yii::$app->params['pageTitle'];
                $content = Yii::t('app', 'user_actvate_account_body', [
                        'page_title' => Yii::$app->params['pageTitle'],
                        'user_ip' => $UserRegisterIp,
                        'administrator' => Yii::$app->params['adminName'],
                        'page_link' => Yii::$app->params['pageUrl'].'activate/'.$UserData['user_id'].'/'.$UserData['user_key'],
                    ]
                );

                (new MailHelper())->send($address, $subject, $content);
                $transaction->commit();
            } catch (\Exception $e) {
                $success = false;
                $transaction->rollBack();
            }

            return $this->render('register-success', ['model' => $model, 'success' => $success]);
        }
        else
        {
            return $this->render('register', ['model' => $model]);

        }
    }

    public function actionProfile()
    {
        $dataChanged = false;
        $session = Yii::$app->session;
        if($session['yii_user_id'] != "")
        {
            Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_browse_profile'));

            $request = Yii::$app->request;
            $post = $request->post();
            $model = new User(['scenario' => User::SCENARIO_UPDATEPROFILE]);

            $DataToProfile = $model->SelectProfile();
            $model->user_namesurname = $DataToProfile['user_namesurname'];
            $model->user_phone = $DataToProfile['user_phone'];
            $model->user_about = $DataToProfile['user_about'];

            if ($model->load(Yii::$app->request->post()) && $model->validate())
            {
                Yii::$app->OtherFunctionsComponent->WriteLog(Yii::t('app', 'log_updated_profile'));
                $model->UpdateProfile();
                $dataChanged = true;

                $model->user_namesurname = $post['User']['user_namesurname'];
                $model->user_phone = $post['User']['user_phone'];
                $model->user_about = $post['User']['user_about'];
            }

            return $this->render('profile', ['model' => $model, 'dataChanged' => $dataChanged]);
        }
        else
        {
            $this->goHome();
        }
    }

    public function actionChangepassword()
    {
        $passwordChanged = false;
        $session = Yii::$app->session;
        if($session['yii_user_id'] != "")
        {
            $model = new User(['scenario' => User::SCENARIO_CHANGEPASSWORD]);
            if ($model->load(Yii::$app->request->post()) && $model->validate())
            {
                $model->UpdatePassword();
                $model->user_password = '';
                $model->user_password2 = '';
                $model->user_password3 = '';
                $passwordChanged = true;
            }
            return $this->render('changepassword', ['model' => $model, 'passwordChanged' => $passwordChanged]);
        }
        else
        {
            $this->goHome();
        }
    }

    public function actionRight()
    {
        return $this->render('right');
    }
}
