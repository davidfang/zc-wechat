<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\ResponseReply */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Response Replies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="response-reply-view">

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
       'keyword',
        [
        'attribute'=>'type',
        'value'=>$model->options['type'][$model->type]
        ],
                   'title',
       'url:url',
       'description',
        [
        'attribute'=>'img_banner',
        'format' =>'html',
        'value'=>Html::img(
                Yii::$app->glide->createSignedUrl([
                'glide/index',
                'path' => $model->img_banner,
                //'w' => 100
                ], true),
                ['class' => 'article-thumb img-rounded pull-left']
                )
        ],
                    [
        'attribute'=>'img_icon',
        'format' =>'html',
        'value'=>Html::img(
                Yii::$app->glide->createSignedUrl([
                'glide/index',
                'path' => $model->img_icon,
                //'w' => 100
                ], true),
                ['class' => 'article-thumb img-rounded pull-left']
                )
        ],
                   'musicurl:url',
       'hqmusicurl:url',
       'ThumbMediaId',
       'voice',
       'video',
        [
        'attribute'=>'img_picture',
        'format' =>'html',
        'value'=>Html::img(
                Yii::$app->glide->createSignedUrl([
                'glide/index',
                'path' => $model->img_picture,
                //'w' => 100
                ], true),
                ['class' => 'article-thumb img-rounded pull-left']
                )
        ],
                   'MediaId',
       'priority',
       'show_times:datetime',
                       'created_at:datetime',
             ],
    ]) ?>

</div>
