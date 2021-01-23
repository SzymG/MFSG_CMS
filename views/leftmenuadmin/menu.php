<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;

$this->title = Yii::t('app', 'a_left_menu');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'a_admin'), 'url' => ['/admin/index']];
$this->params['breadcrumbs'][] = $this->title;
?>



<?php

if ($WasPoz) {
    echo '<div class="alert alert-success" role="alert">' . Yii::t('app', 'a_pozition_set') . '</div>';
}

$form = ActiveForm::begin([
    'id' => 'menu-form',
    'action' => Yii::$app->params['pageUrl'] . 'leftmenuadmin/index',
    'enableAjaxValidation' => false,
    'enableClientValidation' => false,
]);

$ItemContentList2['main'] = Yii::t('app', 'a_menu_main');
$ItemContentList2['none'] = '';
$ItemContentList2['pageone'] = Yii::t('app', 'a_menu_page_one');
$ItemContentList2['news'] = Yii::t('app', 'a_menu_news');
$ItemContentList2['newsone'] = Yii::t('app', 'a_menu_news_one');
$ItemContentList2['event'] = Yii::t('app', 'a_menu_events');
$ItemContentList2['eventone'] = Yii::t('app', 'a_menu_event_one');
$TableMakeMenu = array();
$HowManyElements = count($MainAllPages);

for ($m = 0; $m < count($MainAllPages); $m++) {
    if ($MainAllPages[$m]['is_only_for_authorized'] == 1) {
        $NeedLogin = Yii::t('app', 'comm_yes');
    } else {
        $NeedLogin = Yii::t('app', 'comm_no');
    }
    $GoTo = $ItemContentList2[$MainAllPages[$m]['menu_what']];
    echo '<div class="row" style="margin-bottom: 5px;">
<div class="col-md-2"><select name="poz[' . $MainAllPages[$m]['menu_id'] . ']" class="form-control"
style="width: 90px;">';
    for ($p = 0; $p < $HowManyElements; $p++) {
        $Selected = null;
        if ($p == $m) {
            $Selected = 'selected="selected"';
        }
        echo '<option value="' . ($p + 1) . '"' . $Selected . '>' . ($p + 1) . '</option>';
    }
    echo '</select></div>
    <div class="col-md-4">'.$MainAllPages[$m]['menu_title'].'</div>
<div class="col-md-2">'.$NeedLogin.'</div>
<div class="col-md-2">'.$GoTo.'</div>
<div class="col-md-2">'.Html::a(Yii::t('app', 'com_delete_button'),
['/leftmenuadmin/index?delete='.$MainAllPages[$m]['menu_id']], ['data' => ['confirm' => Yii::t('app',
'a_delete_shure_menu')]]).'</div>
</div>';
    $HowManyElementsSub = count($MainSubPages);
    $IsSubOdThisMenu = 0;
    for ($sub = 0; $sub < count($MainSubPages); $sub++) {
        if ($MainSubPages[$sub]['menu_parent_id'] == $MainAllPages[$m]['menu_id']) {
            $IsSubOdThisMenu++;
        }
    }
    for ($sub = 0; $sub < count($MainSubPages); $sub++) {
        if ($MainSubPages[$sub]['menu_parent_id'] == $MainAllPages[$m]['menu_id']) {
            if ($MainSubPages[$sub]['is_only_for_authorized'] == 1) {
                $NeedLogin = Yii::t('app', 'comm_yes');
            } else {
                $NeedLogin = Yii::t('app', 'comm_no');;
            }
            $GoTo = $ItemContentList2[$MainSubPages[$sub]['menu_what']];
            echo '<div class="row" style="margin-bottom: 5px;">
<div class="col-md-2" style="padding-left: 30px;"><select name="poz[' . $MainSubPages[$sub]['menu_id'] . ']"
class="form-control" style="width: 90px;">';
            for ($p = 0; $p < $IsSubOdThisMenu; $p++) {
                $Selected = null;
                if ($p == $sub) {
                    $Selected = 'selected="selected"';
                }
                echo '<option value="' . ($p + 1) . '"' . $Selected . '>' . ($p + 1) . '</option>';
            }
            echo ('</select></div>
<div class="col-md-4" style="padding-left: 30px;">' . $MainSubPages[$sub]['menu_title'] . '</div>
<div class="col-md-2">'.$NeedLogin.'</div>
<div class="col-md-2">'.$GoTo.'</div>
<div class="col-md-2">'.Html::a(Yii::t('app', 'com_delete_button'),
['/leftmenuadmin/index?delete='.$MainSubPages[$sub]['menu_id']], ['data' => ['confirm' => Yii::t('app',
'a_delete_shure')]]).'</div></div>');
        }
    }
}

echo '<div class="row">
<div class="col-md-2"><br /><input type="hidden" name="setpozition" value="yes" /><input type="submit"
value="'.Yii::t('app', 'a_set').'" class="btn btn-primary" /></div>
<div class="col-md-4"></div>
<div class="col-md-2"></div>
<div class="col-md-2"></div>
<div class="col-md-2"></div>
</div>';

ActiveForm::end();
?>
<?php
echo '<h2>'.Yii::t('app', 'a_add_menu_position').'</h2>';
if($WasAdded)
{
    echo '<div class="alert alert-success" role="alert">'.Yii::t('app', 'a_option_menu_saved').'</div>';
}
?>
<div class="leftmenuadmin-index">
<?php $form = ActiveForm::begin([
    'id' =>'login-form',
    'action' => Yii::$app->params['pageUrl'].'leftmenuadmin/index',
    'enableAjaxValidation' => false,
    'enableClientValidation' => false,
]); ?>

<?= $form->field($model, 'menu_title') ?>
<?php

$ItemContentList['main'] = Yii::t('app', 'a_menu_main');
$ItemContentList['none'] = "Rodzic";
$ItemContentList['pageone'] = Yii::t('app', 'a_menu_page_one');
$ItemContentList['news'] = Yii::t('app', 'a_menu_news');
$ItemContentList['newsone'] = Yii::t('app', 'a_menu_news_one');
$ItemContentList['event'] = Yii::t('app', 'a_menu_events');
$ItemContentList['eventone'] = Yii::t('app', 'a_menu_event_one');

echo $form->field($model, 'menu_what')->dropDownList($ItemContentList);
?>
<?php
$ItemList = array();
?>

<?= $form->field($model, 'menu_content_id')->dropDownList($ItemList) ?>
<?php

$ItemSubList[0] = Yii::t('app', 'a_no');

foreach($MainsTable as $Key=>$Value)
{
    $ItemSubList[$Key] = $Value;
}

echo $form->field($model, 'menu_parent_id')->dropDownList($ItemSubList);
?>
<?php

$ItemLoginList[0] = Yii::t('app', 'a_no');
$ItemLoginList[1] = Yii::t('app', 'a_yes');
echo $form->field($model, 'is_only_for_authorized')->dropDownList($ItemLoginList);
?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'a_menu_add'), ['class' =>'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script>

   $("#leftmenuadmin-menu_what").change(function () {
       var str = "";
       $("#leftmenuadmin-menu_what option:selected").each(function()
       {
            if($(this).val() == "main")
            {
                var newOptions = {"<?php echo Yii::t('app', 'a_menu_main'); ?>": "main"};
                var $el = $("#leftmenuadmin-menu_content_id");
                $("#leftmenuadmin-menu_parent_id option:not(:selected)").prop( "disabled", false );
                $el.empty();
                $.each(newOptions, function(key,value)
                {
                    $el.append($("<option></option>").attr("value", value).text(key));
                });
            }
           else if($(this).val() == "none")
           {
               var $el = $("#leftmenuadmin-menu_content_id");
               $el.empty();
               $el.append($("<option></option>").attr("value", 0).text("Brak"));
               $("#leftmenuadmin-menu_parent_id").val(0).change();
               $("#leftmenuadmin-menu_parent_id option:not(:selected)").prop( "disabled", true );
           }
            else if($(this).val() == "page")
            {
                var newOptions = {"<?php echo Yii::t('app', 'a_menu_page'); ?>": "page"};
                var $el = $("#leftmenuadmin-menu_content_id");
                $el.empty();
                $("#leftmenuadmin-menu_parent_id option:not(:selected)").prop( "disabled", false );
                $.each(newOptions, function(key,value)
                {
                    $el.append($("<option></option>").attr("value", value).text(key));
                });
            }
            else if($(this).val() == "pageone")
            {
                $("#leftmenuadmin-menu_content_id").empty();
                $("#leftmenuadmin-menu_parent_id option:not(:selected)").prop( "disabled", false );
                <?php
                empty($TableReady);
                $TableReady = array();
                foreach($PageTable as $Key=>$Value)
                {
                $TableReady[] = '"'.$Value.'": "'.$Key.'"';
                ?>
                    $("#leftmenuadmin-menu_content_id").append( "<option value=\"<?php echo $Key; ?>\"><?php echo $Key.' -'.$Value; ?></option>" );
                <?php
                }
                ?>
            }
            else if($(this).val() == "news")
            {
                var newOptions = {"<?php echo Yii::t('app', 'a_menu_news'); ?>": "news"};
                var $el = $("#leftmenuadmin-menu_content_id");
                $("#leftmenuadmin-menu_parent_id option:not(:selected)").prop( "disabled", false );
                $el.empty();
                $.each(newOptions, function(key,value)
                {
                    $el.append($("<option></option>").attr("value", value).text(key));
                });
            }
            else if($(this).val() == "newsone")
            {
                $("#leftmenuadmin-menu_content_id").empty();
                $("#leftmenuadmin-menu_parent_id option:not(:selected)").prop( "disabled", false );
                <?php
                empty($TableReady);
                $TableReady = array();
                foreach($EntriesTable as $Key=>$Value)
                {
                $TableReady[] = '"'.$Value.'": "'.$Key.'"';
                ?>
                $("#leftmenuadmin-menu_content_id").append( "<option value=\"<?php echo $Key; ?>\"><?php echo $Key.' -'.$Value; ?></option>" );
                <?php
                }
                ?>
            }
            else if($(this).val() == "event")
            {
                var newOptions = {"<?php echo Yii::t('app', 'a_menu_events'); ?>": "event"};
                var $el = $("#leftmenuadmin-menu_content_id");
                $el.empty();
                $("#leftmenuadmin-menu_parent_id option:not(:selected)").prop( "disabled", false );
                $.each(newOptions, function(key,value)
                {
                    $el.append($("<option></option>").attr("value", value).text(key));
                });
            }
            else if($(this).val() == "eventone")
            {
                $("#leftmenuadmin-menu_content_id").empty();
                $("#leftmenuadmin-menu_parent_id option:not(:selected)").prop( "disabled", false );
                <?php
                empty($EventsTable);
                $TableReady = array();
                foreach($EventsTable as $Key=>$Value)
                {
                    $TableReady[] = '"'.$Value.'": "'.$Key.'"';
                ?>
                $("#leftmenuadmin-menu_content_id").append( "<option value=\"<?php echo $Key; ?>\"><?php echo $Key.' -'.$Value; ?></option>" );
                <?php
                }
                ?>
            }
       });
   })

</script>
