<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model zc\wechat\models\RequestLocation */

$this->title = '添加 Request Location';
$this->params['breadcrumbs'][] = ['label' => 'Request Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-location-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
