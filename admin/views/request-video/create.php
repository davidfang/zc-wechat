<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model zc\wechat\models\RequestVideo */

$this->title = '添加 Request Video';
$this->params['breadcrumbs'][] = ['label' => 'Request Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-video-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
