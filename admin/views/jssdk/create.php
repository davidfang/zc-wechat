<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model zc\wechat\models\Jssdk */

$this->title = '添加 Jssdk';
$this->params['breadcrumbs'][] = ['label' => 'Jssdks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jssdk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
