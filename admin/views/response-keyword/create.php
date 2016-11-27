<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model zc\wechat\models\ResponseKeyword */

$this->title = '添加 Response Keyword';
$this->params['breadcrumbs'][] = ['label' => 'Response Keywords', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="response-keyword-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
