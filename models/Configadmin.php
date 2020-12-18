<?php

namespace app\models;

use Yii;

class Configadmin extends \yii\db\ActiveRecord
{
    public $config_title;
    public $config_description;
    public $config_keywords;
    public $config_rootemail;
    public $config_foot;
    public $config_smtp_host;
    public $config_smtp_password;
    public $config_smtp_port;
    public $config_smtp_is_ssl;
    public $config_smtp_address_from;
    public $config_smtp_address_from_name;
    public $config_smtp_noreply;

    public static function tableName()
    {
        return '{{%config}}';
    }

    public function rules()
    {
        return [
            [['config_title', 'config_description', 'config_keywords', 'config_rootemail', 'config_foot',
                'config_smtp_host', 'config_smtp_password', 'config_smtp_port', 'config_smtp_is_ssl',
                'config_smtp_address_from', 'config_smtp_address_from_name', 'config_smtp_noreply'],
                'required'],
            [['config_rootemail'], 'email'],
        ];
    }

    public function SaveUserData()
    {
        Yii::$app->db->createCommand('UPDATE {{%config}} SET config_value = :config_value WHERE config_name =
"title"')->bindParam(':config_value', $this->config_title)->execute();
        Yii::$app->db->createCommand('UPDATE {{%config}} SET config_value = :config_value WHERE config_name =
"description"')->bindParam(':config_value', $this->config_description)->execute();
        Yii::$app->db->createCommand('UPDATE {{%config}} SET config_value = :config_value WHERE config_name =
"keywords"')->bindParam(':config_value', $this->config_keywords)->execute();
        Yii::$app->db->createCommand('UPDATE {{%config}} SET config_value = :config_value WHERE config_name =
"rootemail"')->bindParam(':config_value', $this->config_rootemail)->execute();
        Yii::$app->db->createCommand('UPDATE {{%config}} SET config_value = :config_value WHERE config_name =
"foot"')->bindParam(':config_value', $this->config_foot)->execute();
        Yii::$app->db->createCommand('UPDATE {{%config}} SET config_value = :config_value WHERE config_name =
"smtp_host"')->bindParam(':config_value', $this->config_smtp_host)->execute();
        Yii::$app->db->createCommand('UPDATE {{%config}} SET config_value = :config_value WHERE config_name =
"smtp_password"')->bindParam(':config_value', $this->config_smtp_password)->execute();
        Yii::$app->db->createCommand('UPDATE {{%config}} SET config_value = :config_value WHERE config_name =
"smtp_port"')->bindParam(':config_value', $this->config_smtp_port)->execute();
        Yii::$app->db->createCommand('UPDATE {{%config}} SET config_value = :config_value WHERE config_name =
"smtp_is_ssl"')->bindParam(':config_value', $this->config_smtp_is_ssl)->execute();
        Yii::$app->db->createCommand('UPDATE {{%config}} SET config_value = :config_value WHERE config_name =
"smtp_address_from"')->bindParam(':config_value', $this->config_smtp_address_from)->execute();
        Yii::$app->db->createCommand('UPDATE {{%config}} SET config_value = :config_value WHERE config_name =
"smtp_address_from_name"')->bindParam(':config_value', $this->config_smtp_address_from_name)->execute();
        Yii::$app->db->createCommand('UPDATE {{%config}} SET config_value = :config_value WHERE config_name =
"smtp_noreply"')->bindParam(':config_value', $this->config_smtp_noreply)->execute();
    }

    public function DataInsert()
    {
        $QueryDataIs = Yii::$app->db->createCommand('SELECT * FROM {{%config}}')
            ->queryAll();
        for ($c = 0; $c < count($QueryDataIs); $c++) {
            if ($QueryDataIs[$c]['config_name'] == 'title') {
                $this->config_title = $QueryDataIs[$c]['config_value'];
            }
            if ($QueryDataIs[$c]['config_name'] == 'description') {
                $this->config_description = $QueryDataIs[$c]['config_value'];
            }
            if ($QueryDataIs[$c]['config_name'] == 'keywords') {
                $this->config_keywords = $QueryDataIs[$c]['config_value'];
            }
            if ($QueryDataIs[$c]['config_name'] == 'rootemail') {
                $this->config_rootemail = $QueryDataIs[$c]['config_value'];
            }
            if ($QueryDataIs[$c]['config_name'] == 'foot') {
                $this->config_foot = $QueryDataIs[$c]['config_value'];
            }
            if ($QueryDataIs[$c]['config_name'] == 'smtp_host') {
                $this->config_smtp_host = $QueryDataIs[$c]['config_value'];
            }
            if ($QueryDataIs[$c]['config_name'] == 'smtp_password') {
                $this->config_smtp_password = $QueryDataIs[$c]['config_value'];
            }
            if ($QueryDataIs[$c]['config_name'] == 'smtp_port') {
                $this->config_smtp_port = $QueryDataIs[$c]['config_value'];
            }
            if ($QueryDataIs[$c]['config_name'] == 'smtp_is_ssl') {
                $this->config_smtp_is_ssl = $QueryDataIs[$c]['config_value'];
            }
            if ($QueryDataIs[$c]['config_name'] == 'smtp_address_from') {
                $this->config_smtp_address_from = $QueryDataIs[$c]['config_value'];
            }
            if ($QueryDataIs[$c]['config_name'] == 'smtp_address_from_name') {
                $this->config_smtp_address_from_name = $QueryDataIs[$c]['config_value'];
            }
            if ($QueryDataIs[$c]['config_name'] == 'smtp_noreply') {
                $this->config_smtp_noreply = $QueryDataIs[$c]['config_value'];
            }
        }

    }

    public function GetConfig()
    {
        $QueryDataIs = Yii::$app->db->createCommand('SELECT * FROM {{%config}}')
            ->queryAll();
        for($c=0;$c<count($QueryDataIs);$c++)
        {
            $Config[$QueryDataIs[$c]['config_name']] = $QueryDataIs[$c]['config_value'];
        }
        return $Config;
    }

    public function attributeLabels()
    {
        return [
            'config_id' => Yii::t('app', 'config_id'),
            'config_name' => Yii::t('app', 'config_name'),
            'config_value' => Yii::t('app', 'config_value'),
            'config_title' => Yii::t('app', 'config_title'),
            'config_description' => Yii::t('app', 'config_description'),
            'config_keywords' => Yii::t('app', 'config_keywords'),
            'config_rootemail' => Yii::t('app', 'config_rootemail'),
            'config_foot' => Yii::t('app', 'config_foot'),
            'config_smtp_host' => Yii::t('app', 'config_smtp_host'),
            'config_smtp_password' => Yii::t('app', 'config_smtp_password'),
            'config_smtp_port' => Yii::t('app', 'config_smtp_port'),
            'config_smtp_is_ssl' => Yii::t('app', 'config_smtp_is_ssl'),
            'config_smtp_address_from' => Yii::t('app', 'config_smtp_address_from'),
            'config_smtp_address_from_name' => Yii::t('app', 'config_smtp_address_from_name'),
            'config_smtp_noreply' => Yii::t('app', 'config_smtp_noreply'),
        ];
    }



}
