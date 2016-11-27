<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model zc\wechat\models\EventMenu */

$this->title = '添加 Event Menu';
$this->params['breadcrumbs'][] = ['label' => 'Event Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-menu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
