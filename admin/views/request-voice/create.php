<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model zc\wechat\models\RequestVoice */

$this->title = '添加 Request Voice';
$this->params['breadcrumbs'][] = ['label' => 'Request Voices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-voice-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
