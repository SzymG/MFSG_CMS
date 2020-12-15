<?php
namespace app\models;
use Yii;
use yii\base\Model;

class Page extends Model {
    public $page_id;
    public $page_title;
    public $page_text;
    public $is_only_for_authorized;
    public $is_active;
    public $page_url;

    public static function tableName()
    {
        return 'page';
    }

    public function CountAll()
    {
        $query = Yii::$app->db->createCommand('SELECT count(page_id) AS HowManyRecords FROM {{%page}} WHERE is_active = 1 ');
        $session = Yii::$app->session;
        if($session['yii_user_id'] == "") {
            $query = Yii::$app->db->createCommand('SELECT count(page_id) AS HowManyRecords FROM {{%page}} WHERE is_active = 1 AND is_only_for_authorized = 0');
        }

        $QueryData = $query->queryScalar();
        $ToReturn = 0;
        if($QueryData != false)
        {
            $ToReturn = $QueryData;
        }
        return $ToReturn;
    }

    public function SelectPages($Start,$Limit)
    {
        $query = Yii::$app->db->createCommand('SELECT * FROM {{%page}} WHERE is_active = 1 ORDER BY page_id DESC LIMIT
            :start,:limit');

        $session = Yii::$app->session;
        if($session['yii_user_id'] == "") {
            $query = Yii::$app->db->createCommand('SELECT * FROM {{%page}} WHERE is_active = 1 AND is_only_for_authorized = 0 ORDER BY page_id DESC LIMIT
            :start,:limit');
        }

        $QueryData = $query
            ->bindParam(':start', $Start)
            ->bindParam(':limit', $Limit)
            ->queryAll();

        return $QueryData;
    }

    public function SelectOnePage($PageId)
    {
        $query = Yii::$app->db->createCommand('SELECT * FROM {{%page}} WHERE page_id = :page_id AND is_active = 1 ');

        $session = Yii::$app->session;
        if($session['yii_user_id'] == "") {
            $query = Yii::$app->db->createCommand('SELECT * FROM {{%page}} WHERE page_id = :page_id AND is_active = 1 AND is_only_for_authorized = 0');
        }

        $query->bindParam(':page_id', $PageId);
        $QueryData = $query->queryOne();
        
        if($QueryData == false)
        {
            $ToReturn = false;
        }
        else
        {
            $ToReturn = true;
            $this->page_title = $QueryData['page_title'];
            $this->page_text = $QueryData['page_text'];
            $this->is_only_for_authorized = $QueryData['is_only_for_authorized'];
            $this->is_active = $QueryData['is_active'];
            $this->page_url = $QueryData['page_url'];
        }

        return $ToReturn;
    }

    public function SelectHome()
    {
        $QueryData = Yii::$app->db->createCommand('SELECT * FROM {{%page}} WHERE page_main = 1')
            ->queryOne();

        if($QueryData == false)
        {
            $ToReturn = false;
        }
        else
        {
            $ToReturn = true;
            $this->page_title = $QueryData['page_title'];
            $this->page_text = $QueryData['page_text'];
            $this->is_only_for_authorized = $QueryData['is_only_for_authorized'];
            $this->is_active = $QueryData['is_active'];
            $this->page_url = $QueryData['page_url'];
        }

        return $ToReturn;
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
