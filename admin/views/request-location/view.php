<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\RequestLocation */

$this->title = $model->MsgId;
$this->params['breadcrumbs'][] = ['label' => 'Request Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-location-view">

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
       'Location_X',
       'Location_Y',
       'Scale',
       'Label',
       'MsgId',
                       'created_at:datetime',
             ],
    ]) ?>

</div>
