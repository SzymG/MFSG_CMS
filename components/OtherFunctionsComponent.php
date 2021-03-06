<?php

namespace app\components;

use Yii;
use yii\base\Component;
use app\models\Logadmin;
use app\models\Configadmin;
use app\models\Leftmenuadmin;

class OtherFunctionsComponent extends Component
{

    public function WriteLog($What, $Message = null)
    {
        $session = Yii::$app->session;
        $logUser = new Logadmin();
        $logUser->log_user_id = $session['yii_user_id'];
        $logUser->log_what = $What;
        $logUser->log_message = $Message;
        $logUser->log_time = date('Y-m-d H:i:s');
        $logUser->log_ip= $_SERVER['REMOTE_ADDR'];
        $logUser->save();
    }

    public function GetConfigData()
    {
        $ConfigAdmin = new Configadmin();
        $Config = $ConfigAdmin->GetConfig();
        return $Config;

    }

    public function MakeUrl($What, $Id = '', $Extra = '')
    {
        if ($What == 'main') {
            $Url = Yii::$app->params['pageUrl'];
        } elseif ($What == 'none') {
            $Url = Yii::$app->params['pageUrl'];
        } elseif ($What == 'login') {
            $Url = Yii::$app->params['pageUrl'] . 'login';
        } elseif ($What == 'logout') {
            $Url = Yii::$app->params['pageUrl'] . 'logout';
        } elseif ($What == 'changepassword') {
            $Url = Yii::$app->params['pageUrl'] . 'change-password';
        } elseif ($What == 'profil') {
            $Url = Yii::$app->params['pageUrl'] . 'profile';
        } elseif ($What == 'register') {
            $Url = Yii::$app->params['pageUrl'] . 'register';
        } elseif ($What == 'password') {
            $Url = Yii::$app->params['pageUrl'] . 'remind-password';
        } elseif ($What == 'contact') {
            $Url = Yii::$app->params['pageUrl'] . 'contact';
        } elseif ($What == 'download') {
            $Url = Yii::$app->params['pageUrl'] . 'download';
        } elseif ($What == 'page') {
            $Url = Yii::$app->params['pageUrl'] . 'page';
        } elseif ($What == 'news') {
            $Url = Yii::$app->params['pageUrl'] . 'news';
        } elseif ($What == 'event') {
            $Url = Yii::$app->params['pageUrl'] . 'event';
        } elseif ($What == 'pageone') {
            $Url = Yii::$app->params['pageUrl'] . 'page/' . $Extra . '/' . $Id;
        } elseif ($What == 'newsone') {
            $Url = Yii::$app->params['pageUrl'] . 'news/' . $Extra . '/' . $Id;
        } elseif ($What == 'eventone') {
            $Url = Yii::$app->params['pageUrl'] . 'event/' . $Extra . '/' . $Id;
        }
        if (!isset($Url)) {
            $Url = 'error';
        }
        return $Url;
    }

    public function GetMenu($IsLogged = '')
    {
        $Items = array();
        $AboutData = array();
        $MainAllPages = Leftmenuadmin::find()
            ->where(['menu_parent_id' => 0])
            ->asArray()
            ->orderBy('menu_poz')
            ->all();
        $MainSubPages = Leftmenuadmin::find()
            ->where('menu_parent_id != 0')
            ->asArray()
            ->orderBy('menu_poz')
            ->all();

        if ($IsLogged != "") {
            $UserLogged = true;
        }

        $HowManyElements = count($MainAllPages);
        $HowManyElementsSub = count($MainSubPages);

        $IsSubOdThisMenu = 0;
        for ($m = 0; $m < count($MainAllPages); $m++) {
            $MainAllPages[$m]['has_submenu'] = false;

            for ($sub = 0; $sub < count($MainSubPages); $sub++) {
                if ($MainSubPages[$sub]['menu_parent_id'] == $MainAllPages[$m]['menu_id']) {
                    $MainAllPages[$m]['has_submenu'] = true;
                }
            }

            if ($MainAllPages[$m]['has_submenu']) {
                $SubPages = null;
                $SubPages = array();
                for ($sub = 0; $sub < count($MainSubPages); $sub++) {
                    if ($MainSubPages[$sub]['menu_parent_id'] == $MainAllPages[$m]['menu_id']) {
                        if ($MainSubPages[$sub]['is_only_for_authorized'] == 1) {
                            if ($UserLogged) {
                                $SubPages[] = array('label' => $MainSubPages[$sub]['menu_title'], 'url' => $this ->MakeUrl($AboutData, $MainSubPages[$sub]['menu_what'], $MainSubPages[$sub]['menu_content_id'], $MainSubPages[$sub]['menu_extra']));
}
                        } else {
                            $SubPages[] = array('label' => $MainSubPages[$sub]['menu_title'], 'url' => $this ->MakeUrl($AboutData, $MainSubPages[$sub]['menu_what'], $MainSubPages[$sub]['menu_content_id'], $MainSubPages[$sub]['menu_extra']));
}
                    }
                }
                if (count($SubPages) > 0) {
                    $ItemsElement = array('label' => $MainAllPages[$m]['menu_title'], 'items' => $SubPages);
                } else {
                    if ($MainAllPages[$m]['is_only_for_authorized'] == 1) {
                        if ($UserLogged) {
                            $ItemsElement = array('label' => $MainAllPages[$m]['menu_title'], 'url' => $this ->MakeUrl($AboutData, $MainAllPages[$m]['menu_what'], $MainAllPages[$m]['menu_content_id'], $MainAllPages[$m]['menu_extra']));
array_push($Items, $ItemsElement);
}
                    } else {
                        $ItemsElement = array('label' => $MainAllPages[$m]['menu_title'], 'url' => $this ->MakeUrl($AboutData, $MainAllPages[$m]['menu_what'], $MainAllPages[$m]['menu_content_id'], $MainAllPages[$m]['menu_extra']));
array_push($Items, $ItemsElement);
}
                }
            }
        }

        return $Items;
    }
}
