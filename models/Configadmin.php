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

    public static function tableName()
    {
        return '{{%config}}';
    }

    public function rules()
    {
        return [
            [['config_title', 'config_description', 'config_keywords', 'config_rootemail', 'config_foot'],
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
        ];
    }



}
