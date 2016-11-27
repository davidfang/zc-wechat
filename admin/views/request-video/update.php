<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\RequestVideo */

$this->title = '编辑 Request Video: ' . ' ' . $model->MsgId;
$this->params['breadcrumbs'][] = ['label' => 'Request Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->MsgId, 'url' => ['view', 'id' => $model->MsgId]];
$this->params['breadcrumbs'][] = '编辑';
?>
<div class="request-video-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
       'model' => $model,
    ]) ?>

</div>