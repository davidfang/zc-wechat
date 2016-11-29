<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\ResponseKeyValue */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Response Key Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="response-key-value-view">

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
                   'label'=>'keyword_id',
                   'value'=>$model->keyWord->keyword
               ],
               [
                   'label'=>'reply_id',
                   'value'=>$model->keyReply->keyword
               ],
               [
                   'label'=>'回复标题',
                   'value'=>$model->keyReply->title
               ],
               'created_at:datetime',
             ],
    ]) ?>

</div>
