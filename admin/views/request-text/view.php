<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\RequestText */

$this->title = $model->MsgId;
$this->params['breadcrumbs'][] = ['label' => 'Request Texts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-text-view">

    <p>
        <?= Html::a('编辑', ['update', 'id' => $model->MsgId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->MsgId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '你确定要删除此条信息?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
       'ToUserName',
       'FromUserName',
       'CreateTime:datetime',
       'MsgType',
       'Content',
       'MsgId',
                       'created_at:datetime',
             ],
    ]) ?>

</div>
