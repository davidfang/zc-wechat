<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model zc\wechat\models\RequestText */

$this->title = '添加 Request Text';
$this->params['breadcrumbs'][] = ['label' => 'Request Texts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-text-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
