<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\RequestLink */

$this->title = $model->Title;
$this->params['breadcrumbs'][] = ['label' => 'Request Links', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-link-view">

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
       'Title',
       'Description',
       'Url:url',
       'MsgId',
                       'created_at:datetime',
             ],
    ]) ?>

</div>
