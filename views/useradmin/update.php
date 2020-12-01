<?php
use yii\helpers\Html;

$this->title = Yii::t('app', 'a_users_update_header').': '.$model->user_email;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'a_admin'), 'url' => ['/admin/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'a_users_update_header'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="useradmin-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
        $model->user_root => 'NIE'

    ]) ?>
</div>
