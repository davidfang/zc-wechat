<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\Scene */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Scenes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
       'name',
       'describtion',
       'subscribeNumber',
       'type',
       'expireSeconds',
       'sceneId',
       'Ticket',
       'TicketTime',
       'isCreated',
                       'created_at:datetime',
                                    'updated_at:datetime',
             ],
    ]) ?>

</div>
