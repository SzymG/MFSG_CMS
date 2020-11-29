<?php
namespace app\models;
use Yii;


class Leftmenuadmin extends \yii\db\ActiveRecord
{
    public $menu_id;
    public $menu_title;
    public $menu_poz;
    public $menu_sub;
    public $menu_login;
    public $menu_what;
    public $menu_content_id;
    public $menu_extra;

    public static function tableName()
    {
        return '{{%menu}}';
    }

    public function rules() {
        return [
            [['menu_title', 'menu_sub', 'menu_login', 'menu_what', 'menu_content_id'], 'required'],
        ];
    }

    public function SaveData()
    {
        if($this->menu_poz == ""){$this->menu_poz = 0;}
        if($this->menu_sub == ""){$this->menu_sub = 0;}
        $QueryData = Yii::$app->db->createCommand('INSERT INTO {{%menu}} (menu_title, menu_poz, menu_sub,
menu_login, menu_what, menu_content_id, menu_extra)
values
(:menu_title,:menu_poz, :menu_sub, :menu_login, :menu_what, :menu_content_id, :menu_extra)
')
            ->bindParam(':menu_title', $this->menu_title)
            ->bindParam(':menu_poz', $this->menu_poz)
            ->bindParam(':menu_sub', $this->menu_sub)
            ->bindParam(':menu_login', $this->menu_login)
            ->bindParam(':menu_what', $this->menu_what)
            ->bindParam(':menu_content_id', $this->menu_content_id)
            ->bindParam(':menu_extra', $this->menu_extra)
            ->execute();
    }

    public function DeleteMenu($MenuId)
    {
        $QueryData = Yii::$app->db->createCommand('DELETE FROM {{%menu}} WHERE menu_id = :menu_id')
            ->bindParam(':menu_id', $MenuId)
            ->execute();

        $QueryData = Yii::$app->db->createCommand('DELETE FROM {{%menu}} WHERE menu_sub = :menu_sub')
            ->bindParam(':menu_sub', $MenuId)
            ->execute();

    }

    public function SetPozition($Key,$Value)
    {
        $QueryData = Yii::$app->db->createCommand('UPDATE {{%menu}} SET menu_poz = :menu_poz WHERE menu_id = :menu_id')
            ->bindParam(':menu_poz', $Value)
            ->bindParam(':menu_id', $Key)
            ->execute();
    }

    public function attributeLabels()
    {
        return [
            'menu_id' => Yii::t('app', 'menu_id'),
            'menu_title' => Yii::t('app', 'menu_title'),
            'menu_what' => Yii::t('app', 'menu_what'),
            'menu_content_id' => Yii::t('app', 'menu_content_id'),
            'menu_poz' => Yii::t('app', 'menu_poz'),
            'menu_sub' => Yii::t('app', 'menu_sub'),
            'menu_login' => Yii::t('app', 'menu_login'),
            'menu_extra' => Yii::t('app', 'menu_extra')
        ];
    }
}
