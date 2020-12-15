<?php

use app\models\Leftmenuadmin;

$session = Yii::$app->session;

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="profile" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">MFSG_CMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <?php
        if($session['yii_user_id'] != "") {
        ?>
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/anonymous-user.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $session["yii_user_email"]?></a>
            </div>
        </div>
        <?php } ?>

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

                    if($page['menu_what'] == 'eventone' || $page['menu_what'] == 'newsone' || $page['menu_what'] == 'pageone'){
                        $url = '/'.str_replace('one', '', $page['menu_what']).'/'.$page['menu_extra'].'/'.$page['menu_content_id'];
                    }else{
                        $url = '/'.$page['menu_what'];
                    }

                    $subItem = [];

                    foreach($MainSubPages as $subPage){
                        if($subPage['menu_parent_id'] == $page['menu_id']){
                            if($subPage['menu_what'] == 'eventone' || $subPage['menu_what'] == 'newsone' || $subPage['menu_what'] == 'pageone'){
                                $subUrl = '/'.str_replace('one', '', $subPage['menu_what']).'/'.$subPage['menu_extra'].'/'.$subPage['menu_content_id'];
                            }else{
                                $subUrl = '/'.$subPage['menu_what'];
                            }
                            $subItem[] = ['label' => $subPage['menu_title'], 'url' => [$subUrl], 'icon' => ''];
                        }
                    }
                    if ($subItem == []) {
                        echo \hail812\adminlte3\widgets\Menu::widget([
                            'items' => [
                                ['label' => $page['menu_title'], 'url' => [$url], 'icon' => ''],
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
                /*'items' => [
                    [
                        'label' => 'Starter Pages',
                        'icon' => 'tachometer-alt',
                        'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'Active Page', 'url' => ['site/index'], 'iconStyle' => 'far'],
                            ['label' => 'Inactive Page', 'iconStyle' => 'far'],
                        ]
                    ],
                    ['label' => 'Simple Link', 'icon' => 'th', 'badge' => '<span class="right badge badge-danger">New</span>'],
                    ['label' => 'Yii2 PROVIDED', 'header' => true],
                    ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
                    ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank'],
                    ['label' => 'MULTI LEVEL EXAMPLE', 'header' => true],
                    ['label' => 'Level1'],
                    [
                        'label' => 'Level1',
                        'items' => [
                            ['label' => 'Level2', 'iconStyle' => 'far'],
                            [
                                'label' => 'Level2',
                                'iconStyle' => 'far',
                                'items' => [
                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle']
                                ]
                            ],
                            ['label' => 'Level2', 'iconStyle' => 'far']
                        ]
                    ],
                    ['label' => 'Level1'],
                    ['label' => 'LABELS', 'header' => true],
                    ['label' => 'Important', 'iconStyle' => 'far', 'iconClassAdded' => 'text-danger'],
                    ['label' => 'Warning', 'iconClass' => 'nav-icon far fa-circle text-warning'],
                    ['label' => 'Informational', 'iconStyle' => 'far', 'iconClassAdded' => 'text-info'],
                ],*/

            ?>
        </nav>
        <!-- /.sidebar-menu -->

    </div>
    <!-- /.sidebar -->
</aside>
