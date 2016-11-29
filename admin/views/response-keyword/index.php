<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use zc\wechat\models\Wechat;

/* @var $this yii\web\View */
/* @var $searchModel zc\wechat\models\ResponseKeywordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Response Keywords';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$wechats = ArrayHelper::map(Wechat::getOnWechats(), 'id', 'name');

?>
<div class="response-keyword-index">

    <p>
        <?= Html::a('添加 Response Keyword', ['create'], ['class' => 'btn btn-success']) ?>
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
            'keyword',
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
                       'priority',
           'times',
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
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                /*'buttons' => [
                    'type_text' => function ($url, $model, $key) {
                        return $model->type == 'text' ? '' : Html::button('Text', ['class' => 'btn btn-primary btn-sm', 'onclick' => "javascript:changeStatus('type','text','{$model->id}');"]);
                    },
                    'type_image' => function ($url, $model, $key) {
                        return $model->type == 'image' ? '' : Html::button('Image', ['class' => 'btn btn-primary btn-sm', 'onclick' => "javascript:changeStatus('type','image','{$model->id}');"]);
                    },
                    'type_voice' => function ($url, $model, $key) {
                        return $model->type == 'voice' ? '' : Html::button('Voice', ['class' => 'btn btn-primary btn-sm', 'onclick' => "javascript:changeStatus('type','voice','{$model->id}');"]);
                    },
                    'type_video' => function ($url, $model, $key) {
                        return $model->type == 'video' ? '' : Html::button('Video', ['class' => 'btn btn-primary btn-sm', 'onclick' => "javascript:changeStatus('type','video','{$model->id}');"]);
                    },
                    'type_music' => function ($url, $model, $key) {
                        return $model->type == 'music' ? '' : Html::button('Music', ['class' => 'btn btn-primary btn-sm', 'onclick' => "javascript:changeStatus('type','music','{$model->id}');"]);
                    },
                    'type_news' => function ($url, $model, $key) {
                        return $model->type == 'news' ? '' : Html::button('News', ['class' => 'btn btn-primary btn-sm', 'onclick' => "javascript:changeStatus('type','news','{$model->id}');"]);
                    },
               ],*/
                'template' => '{type_text} {type_image} {type_voice} {type_video} {type_music} {type_news}  {view} {update}{delete} ',
            ]
        ],
    ]);
    ?>
    </div>
</div>