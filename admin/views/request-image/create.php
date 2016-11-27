<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model zc\wechat\models\RequestImage */

$this->title = '添加 Request Image';
$this->params['breadcrumbs'][] = ['label' => 'Request Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-image-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
