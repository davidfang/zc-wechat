<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\ResponseKeyword */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Response Keywords', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="response-keyword-view">

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
                   'keyword',
                    [
                    'attribute'=>'type',
                    'value'=>$model->options['type'][$model->type]
                    ],
                   'priority',
                    'times',
                       'created_at:datetime',
             ],
    ]) ?>

</div>
