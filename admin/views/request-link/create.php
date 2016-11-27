<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model zc\wechat\models\RequestLink */

$this->title = '添加 Request Link';
$this->params['breadcrumbs'][] = ['label' => 'Request Links', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-link-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
