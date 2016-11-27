<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\Wechat */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Wechats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wechat-view">

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
       'token',
       'access_token',
       'account',
       'original',
        [
        'attribute'=>'type_d',
        'value'=>$model->options['type_d'][$model->type_d]
        ],
                   'appID',
       'secret',
       'encoding_aes_key',
       'base_url:url',
        [
        'attribute'=>'img_avatar',
        'format' =>'html',
        'value'=>Html::img(
                Yii::$app->glide->createSignedUrl([
                'glide/index',
                'path' => $model->img_avatar,
                //'w' => 100
                ], true),
                ['class' => 'article-thumb img-rounded pull-left']
                )
        ],
                    [
        'attribute'=>'img_qrcode',
        'format' =>'html',
        'value'=>Html::img(
                Yii::$app->glide->createSignedUrl([
                'glide/index',
                'path' => $model->img_qrcode,
                //'w' => 100
                ], true),
                ['class' => 'article-thumb img-rounded pull-left']
                )
        ],
                   'address',
       'description',
       'username',
        [
        'attribute'=>'status_d',
        'value'=>$model->options['status_d'][$model->status_d]
        ],
                   'password',
                       'created_at:datetime',
                                    'updated_at:datetime',
                    'adddate',
],
    ]) ?>

</div>
