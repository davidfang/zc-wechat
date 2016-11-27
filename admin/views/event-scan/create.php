<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model zc\wechat\models\EventScan */

$this->title = '添加 Event Scan';
$this->params['breadcrumbs'][] = ['label' => 'Event Scans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-scan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
