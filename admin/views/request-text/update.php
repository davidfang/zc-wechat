<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\RequestText */

$this->title = '编辑 Request Text: ' . ' ' . $model->MsgId;
$this->params['breadcrumbs'][] = ['label' => 'Request Texts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->MsgId, 'url' => ['view', 'id' => $model->MsgId]];
$this->params['breadcrumbs'][] = '编辑';
?>
<div class="request-text-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
       'model' => $model,
    ]) ?>

</div>