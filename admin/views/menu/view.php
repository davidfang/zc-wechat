<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\Menu */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-view">

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
       'pid',
       'name',
        [
        'attribute'=>'type',
        'value'=>$model->options['type'][$model->type]
        ],
                   'code',
        [
        'attribute'=>'status',
        'value'=>$model->options['status'][$model->status]
        ],
                                   'created_at:datetime',
                                    'updated_at:datetime',
             ],
    ]) ?>

</div>
