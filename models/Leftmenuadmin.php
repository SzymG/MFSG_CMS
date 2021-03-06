<?php
namespace app\models;
use Yii;


class Leftmenuadmin extends \yii\db\ActiveRecord
{
    public $menu_id;
    public $menu_title;
    public $menu_poz;
    public $menu_parent_id;
    public $is_only_for_authorized;
    public $menu_what;
    public $menu_content_id;
    public $menu_extra;

    public static function tableName()
    {
        return '{{%menu}}';
    }

    public function rules() {
        return [
            [['menu_title', 'menu_parent_id', 'is_only_for_authorized', 'menu_what', 'menu_content_id'], 'required'],
        ];
    }

    public function SaveData()
    {
        if($this->menu_poz == ""){$this->menu_poz = 0;}
        if($this->menu_parent_id == ""){$this->menu_parent_id = 0;}
        $QueryData = Yii::$app->db->createCommand('INSERT INTO {{%menu}} (menu_title, menu_poz, menu_parent_id,
is_only_for_authorized, menu_what, menu_content_id, menu_extra)
values
(:menu_title,:menu_poz, :menu_parent_id, :is_only_for_authorized, :menu_what, :menu_content_id, :menu_extra)
')
            ->bindParam(':menu_title', $this->menu_title)
            ->bindParam(':menu_poz', $this->menu_poz)
            ->bindParam(':menu_parent_id', $this->menu_parent_id)
            ->bindParam(':is_only_for_authorized', $this->is_only_for_authorized)
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

        $QueryData = Yii::$app->db->createCommand('DELETE FROM {{%menu}} WHERE menu_parent_id = :menu_parent_id')
            ->bindParam(':menu_parent_id', $MenuId)
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
            'menu_parent_id' => Yii::t('app', 'menu_parent_id'),
            'is_only_for_authorized' => Yii::t('app', 'is_only_for_authorized'),
            'menu_extra' => Yii::t('app', 'menu_extra')
        ];
    }
}
