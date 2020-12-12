<?php
$ConfigPage = Yii::$app->OtherFunctionsComponent->GetConfigData();
?>

<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        <?= Yii::powered() ?>
    </div>
    <!-- Default to the left -->
    <?php echo $ConfigPage['foot']; ?>
</footer>