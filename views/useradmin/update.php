<?php
use yii\helpers\Html;

$this->title = Yii::t('app', 'a_users_update_header').': '.$model->user_email;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'a_admin'), 'url' => ['/admin/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'a_users_update_header'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="useradmin-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
