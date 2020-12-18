<?php

use app\models\Leftmenuadmin;
use yii\helpers\Url;

$session = Yii::$app->session;

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Url::to(['/'])?>" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">MFSG_CMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <?php

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

            foreach($MainAllPages as $page){
                if($page['is_only_for_authorized'] == 0 or $session['yii_user_id'] != ''){

                    $url = Yii::$app->OtherFunctionsComponent->MakeUrl($page['menu_what'],$page['menu_content_id'],$page['menu_extra']);
                    $subItem = [];

                    foreach($MainSubPages as $subPage){
                        if($subPage['menu_parent_id'] == $page['menu_id']){
                            $subUrl = Yii::$app->OtherFunctionsComponent->MakeUrl($subPage['menu_what'],$subPage['menu_content_id'], $subPage['menu_extra']);
                            $subItem[] = ['label' => $subPage['menu_title'], 'url' => $subUrl, 'icon' => ''];
                        }
                    }
                    if ($subItem == []) {
                        echo \hail812\adminlte3\widgets\Menu::widget([
                            'items' => [
                                ['label' => $page['menu_title'], 'url' => $url, 'icon' => ''],
                            ]
                        ]);
                    }else{
                        echo \hail812\adminlte3\widgets\Menu::widget([
                            'items' => [
                                ['label' => $page['menu_title'], 'items' => $subItem,'icon' => ''],
                            ]
                        ]);
                    }
                }
            }

            if($session['yii_user_root'] == 1) {
                echo \hail812\adminlte3\widgets\Menu::widget([
                    'items' => [
                        ['label' => Yii::t('app', 'a_admin'), 'header' => true],
                        ['label' => Yii::t('app', 'a_amenu_config'), 'url' => ['/configadmin/index'], 'icon' => 'wrench'],
                        ['label' => Yii::t('app', 'a_amenu_page'), 'url' => ['/pageadmin/index'], 'icon' => 'window-maximize'],
                        ['label' => Yii::t('app', 'a_amenu_events'), 'url' => ['/eventadmin/index'], 'icon' => 'calendar-alt'],
                        ['label' => Yii::t('app', 'a_amenu_news'), 'url' => ['/newsadmin/index'], 'icon' => 'newspaper'],
                        ['label' => Yii::t('app', 'a_amenu_users'), 'items' =>
                            [
                                ['label' => Yii::t('app', 'a_amenu_users'), 'url' => ['/useradmin/index'], 'icon' => 'users'],
                                ['label' => Yii::t('app', 'a_amenu_logs'), 'url' => ['/logadmin/index'], 'icon' => 'stream'],
                            ], 'icon' => 'users-cog'
                        ],
                        ['label' => Yii::t('app', 'a_amenu_left_menu'), 'url' => ['/leftmenuadmin/index'], 'icon' => 'bars'],


                        ]
                ]);
            }

            ?>
        </nav>
        <!-- /.sidebar-menu -->

    </div>
    <!-- /.sidebar -->
</aside>
