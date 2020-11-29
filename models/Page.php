<?php
namespace app\models;
use Yii;
use yii\base\Model;

class Page extends Model {
    public $page_id;
    public $page_title;
    public $page_text;
    public $is_only_for_authorized;
    public $page_url;

    public static function tableName()
    {
        return 'page';
    }

    public function CountAll()
    {
        $QueryData = Yii::$app->db->createCommand('SELECT count(page_id) AS HowManyRecords FROM {{%page}}')
            ->queryScalar();
        $ToReturn = 0;
        if($QueryData != false)
        {
            $ToReturn = $QueryData;
        }
        return $ToReturn;
    }

    public function SelectPages($Start,$Limit)
    {
        $QueryData = Yii::$app->db->createCommand('SELECT * FROM {{%page}} ORDER BY page_id DESC LIMIT :start,:limit')
            ->bindParam(':start', $Start)
            ->bindParam(':limit', $Limit)
            ->queryAll();
        return $QueryData;
    }

    public function SelectOnePage($PageId)
    {
        $QueryData = Yii::$app->db->createCommand('SELECT * FROM {{%page}} WHERE page_id = :page_id')
            ->bindParam(':page_id', $PageId)
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
            $this->page_url = $QueryData['page_url'];
        }

        return $ToReturn;
    }

    public function SelectHome()
    {
        $QueryData = Yii::$app->db->createCommand('SELECT * FROM {{%page}} WHERE page_main = "y"')
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
            'page_url' => Yii::t('app', 'page_url'),
        ];
    }
}
