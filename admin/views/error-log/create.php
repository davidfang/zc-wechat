<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model zc\wechat\models\ErrorLog */

$this->title = '添加 Error Log';
$this->params['breadcrumbs'][] = ['label' => 'Error Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="error-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
