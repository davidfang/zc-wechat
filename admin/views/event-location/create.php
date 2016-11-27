<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model zc\wechat\models\EventLocation */

$this->title = '添加 Event Location';
$this->params['breadcrumbs'][] = ['label' => 'Event Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-location-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
