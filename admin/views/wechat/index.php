<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel zc\wechat\models\WechatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wechats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wechat-index">

    <p>
        <?= Html::a('添加 Wechat', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<div style="overflow: scroll;height: 500px;">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php echo $this->render("_toolbar", ["model" => $dataProvider]); ?>

    <?= GridView::widget([
        'id' => 'grid',
        //重新定义分页样式
        'layout' => '{items}{pager}',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn', 'options' => ['id' => 'grid','style'=>'overflow-x: scroll']],
           'id',
           'name',
           'token',
           'access_token',
           'account',
           //'original',
 [
                'attribute' => 'type_d',
                'format' => 'html',
                'value' => function ($model) {
                    $class = 'label-success';
                    $class = 'label-warning';
                    $class = 'label-danger';
                    $class = 'label-info';
                    return '<span class="label ' . $class . '">' . ($model->options['type_d'][$model->type_d]) . '</span>';
                },
                'options' => ['style' => 'width:90px;'],
                'filter' => $searchModel->options['type_d'],
            ],
                       //'appID',
           //'secret',
           //'encoding_aes_key',
           //'base_url:url',
            [
                'attribute' => 'avatar',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::img(
                                Yii::$app->glide->createSignedUrl([
                                'glide/index',
                                'path' => $model->img_avatar,
                                'w' => 100
                                ], true),
                                ['class' => 'article-thumb img-rounded pull-left']
                            );
                },
                'filter' => false
            ],
                        [
                'attribute' => 'qrcode',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::img(
                                Yii::$app->glide->createSignedUrl([
                                'glide/index',
                                'path' => $model->img_qrcode,
                                'w' => 100
                                ], true),
                                ['class' => 'article-thumb img-rounded pull-left']
                            );
                },
                'filter' => false
            ],
                       //'address',
           //'description',
           //'username',
 [
                'attribute' => 'status_d',
                'format' => 'html',
                'value' => function ($model) {
                    $class = 'label-success';
                    $class = 'label-warning';
                    $class = 'label-danger';
                    $class = 'label-info';
                    return '<span class="label ' . $class . '">' . ($model->options['status_d'][$model->status_d]) . '</span>';
                },
                'options' => ['style' => 'width:90px;'],
                'filter' => $searchModel->options['status_d'],
            ],
                       //'password',
[
                'attribute' => 'created_at',
                'format' => 'html',
                'value' => function ($model) {
                            return Yii::$app->formatter->asDatetime($model->created_at) ;
                            },
                'filter' => kartik\date\DatePicker::widget(
                    ['model' => $searchModel,
                       'name' => Html::getInputName($searchModel, 'created_at'),
                       'value' => $searchModel->created_at,
                       'pluginOptions' => ['format' => 'yyyy-mm-dd',
                           'todayHighlight' => true,]
                    ]),
                'options' => ['style' => 'width:200px;'],

            ],
            [
                'attribute' => 'updated_at',
                'format' => 'html',
                'value' => function ($model) {
                            return Yii::$app->formatter->asDatetime($model->updated_at) ;
                            },
                'filter' => kartik\date\DatePicker::widget(
                    ['model' => $searchModel,
                       'name' => Html::getInputName($searchModel, 'updated_at'),
                       'value' => $searchModel->updated_at,
                       'pluginOptions' => ['format' => 'yyyy-mm-dd',
                           'todayHighlight' => true,]
                    ]),
                'options' => ['style' => 'width:200px;'],

            ],
            [
                'attribute' => 'adddate',
                'format' => 'html',
                'value' => function ($model) {
                            return Yii::$app->formatter->asDatetime($model->adddate) ;
                            },
                'filter' => kartik\date\DatePicker::widget(
                    ['model' => $searchModel,
                       'name' => Html::getInputName($searchModel, 'adddate'),
                       'value' => $searchModel->adddate,
                       'pluginOptions' => ['format' => 'yyyy-mm-dd',
                           'todayHighlight' => true,]
                    ]),
                'options' => ['style' => 'width:200px;'],

            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'buttons' => [
                    'type_d_1' => function ($url, $model, $key) {
                        return $model->type_d == 1 ? '' : Html::button('服务号', ['class' => 'btn btn-primary btn-sm', 'onclick' => "javascript:changeStatus('type_d','1','{$model->id}');"]);
                    },
                    'type_d_2' => function ($url, $model, $key) {
                        return $model->type_d == 2 ? '' : Html::button('订阅号', ['class' => 'btn btn-primary btn-sm', 'onclick' => "javascript:changeStatus('type_d','2','{$model->id}');"]);
                    },
                    'type_d_3' => function ($url, $model, $key) {
                        return $model->type_d == 3 ? '' : Html::button('小程序', ['class' => 'btn btn-primary btn-sm', 'onclick' => "javascript:changeStatus('type_d','3','{$model->id}');"]);
                    },
                    'status_d_0' => function ($url, $model, $key) {
                        return $model->status_d == 0 ? '' : Html::button('暂停', ['class' => 'btn btn-primary btn-sm', 'onclick' => "javascript:changeStatus('status_d','0','{$model->id}');"]);
                    },
                    'status_d_1' => function ($url, $model, $key) {
                        return $model->status_d == 1 ? '' : Html::button('启用', ['class' => 'btn btn-primary btn-sm', 'onclick' => "javascript:changeStatus('status_d','1','{$model->id}');"]);
                    },
               ],
                'template' => '{status_d_0} {status_d_1}  {view} {update}{delete} ',
            ]
        ],
    ]);
    ?>
    </div>
</div>