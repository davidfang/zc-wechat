<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model zc\wechat\models\ResponseReply */

$this->title = '添加 Response Reply';
$this->params['breadcrumbs'][] = ['label' => 'Response Replies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="response-reply-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
