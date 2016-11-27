<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model zc\wechat\models\CurlLog */

$this->title = '添加 Curl Log';
$this->params['breadcrumbs'][] = ['label' => 'Curl Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curl-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
