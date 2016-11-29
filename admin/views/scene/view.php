<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use zc\wechat\models\Wechat;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\Scene */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Scenes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$app = Wechat::getApplication($model->wechat_id);
$qrcode = $app->qrcode;

$url = $qrcode->url($model->Ticket);
?>
<div class="scene-view">

    <p>
        <?= Html::a('编辑', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
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
       'id',
        [
            'attribute'=>'wechat_id',
            'value'=>$model->wechat->name
        ],
        [
            'attribute'=>'url',
            'format' =>'html',
            'value'=>Html::img($url,
                                ['class' => 'img-circle',
                                    'width' => 150]
                                )
        ],
       'name',
       'describtion',
       'subscribeNumber',
        [
        'attribute'=>'type',
        'value'=>$model->options['type'][$model->type]
        ],
                   'expireSeconds',
       'sceneId',
       'Ticket',
       'TicketTime',
        [
        'attribute'=>'isCreated',
        'value'=>$model->options['isCreated'][$model->isCreated]
        ],
                   'url:url',
                       'created_at:datetime',
                                    'updated_at:datetime',
             ],
    ]) ?>

</div>
