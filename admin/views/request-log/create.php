<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model zc\wechat\models\RequestLog */

$this->title = '添加 Request Log';
$this->params['breadcrumbs'][] = ['label' => 'Request Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
