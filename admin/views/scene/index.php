<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use zc\wechat\models\Wechat;

/* @var $this yii\web\View */
/* @var $searchModel zc\wechat\models\SceneSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Scenes';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$wechats = ArrayHelper::map(Wechat::getOnWechats(), 'id', 'name');

?>
<div class="scene-index">

    <p>
        <?= Html::a('添加 Scene', ['create'], ['class' => 'btn btn-success']) ?>
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
            [
                'attribute' => 'wechat_id',
                'format' => 'html',
                'value' => function ($model) {
                    $class = 'label-success';
                    $class = 'label-warning';
                    $class = 'label-danger';
                    $class = 'label-info';

                    return '<span class="label ' . $class . '">' . ($model->wechat->name) . '</span>';
                },
                'options' => ['style' => 'width:90px;'],
                'filter' => Html::activeDropDownList($searchModel,
                    'wechat_id',$wechats,
                    ['prompt'=>'全部']
                ),
            ],
            [
                'label'=>'封面图',
                'format'=>'raw',
                'value'=>function($model){
                    $app = Wechat::getApplication($model->wechat_id);
                    $qrcode = $app->qrcode;

                    $url = $qrcode->url($model->Ticket);
                    return Html::img($url,
                        ['class' => 'img-circle',
                            'width' => 90]
                    );
                }
            ],
           'name',
           'describtion',
           'subscribeNumber',
 [
                'attribute' => 'type',
                'format' => 'html',
                'value' => function ($model) {
                    $class = 'label-success';
                    $class = 'label-warning';
                    $class = 'label-danger';
                    $class = 'label-info';
                    return '<span class="label ' . $class . '">' . ($model->options['type'][$model->type]) . '</span>';
                },
                'options' => ['style' => 'width:90px;'],
                'filter' => $searchModel->options['type'],
            ],
                       //'expireSeconds',
           //'sceneId',
           //'Ticket',
[
                'attribute' => 'TicketTime',
                'format' => 'html',
                'value' => function ($model) {
                            return Yii::$app->formatter->asDatetime($model->TicketTime) ;
                            },
                'filter' => kartik\date\DatePicker::widget(
                    ['model' => $searchModel,
                       'name' => Html::getInputName($searchModel, 'TicketTime'),
                       'value' => $searchModel->TicketTime,
                       'pluginOptions' => ['format' => 'yyyy-mm-dd',
                           'todayHighlight' => true,]
                    ]),
                'options' => ['style' => 'width:200px;'],

            ],
             [
                'attribute' => 'isCreated',
                'format' => 'html',
                'value' => function ($model) {
                    $class = 'label-success';
                    $class = 'label-warning';
                    $class = 'label-danger';
                    $class = 'label-info';
                    return '<span class="label ' . $class . '">' . ($model->options['isCreated'][$model->isCreated]) . '</span>';
                },
                'options' => ['style' => 'width:90px;'],
                'filter' => $searchModel->options['isCreated'],
            ],
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
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'buttons' => [
                    'type_1' => function ($url, $model, $key) {
                        return $model->type == '1' ? '' : Html::button('临时', ['class' => 'btn btn-primary btn-sm', 'onclick' => "javascript:changeStatus('type','1','{$model->id}');"]);
                    },
                    'type_2' => function ($url, $model, $key) {
                        return $model->type == '2' ? '' : Html::button('永久', ['class' => 'btn btn-primary btn-sm', 'onclick' => "javascript:changeStatus('type','2','{$model->id}');"]);
                    },
                    'isCreated_1' => function ($url, $model, $key) {
                        return $model->isCreated == '1' ? '' : Html::button('生成', ['class' => 'btn btn-primary btn-sm', 'onclick' => "javascript:changeStatus('isCreated','1','{$model->id}');"]);
                    },
                    'isCreated_0' => function ($url, $model, $key) {
                        return $model->isCreated == '0' ? '' : Html::button('未生成', ['class' => 'btn btn-primary btn-sm', 'onclick' => "javascript:changeStatus('isCreated','0','{$model->id}');"]);
                    },
               ],
                'template' => '{isCreated_1}   {view} {update}{delete} ',
            ]
        ],
    ]);
    ?>
    </div>
</div>