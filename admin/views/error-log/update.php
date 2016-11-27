<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\ErrorLog */

$this->title = '编辑 Error Log: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Error Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '编辑';
?>
<div class="error-log-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
       'model' => $model,
    ]) ?>

</div>