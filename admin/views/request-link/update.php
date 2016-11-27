<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\RequestLink */

$this->title = '编辑 Request Link: ' . ' ' . $model->Title;
$this->params['breadcrumbs'][] = ['label' => 'Request Links', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Title, 'url' => ['view', 'id' => $model->MsgId]];
$this->params['breadcrumbs'][] = '编辑';
?>
<div class="request-link-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
       'model' => $model,
    ]) ?>

</div>