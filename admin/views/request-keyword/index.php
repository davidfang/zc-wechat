<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel zc\wechat\models\RequestKeywordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Request Keywords';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-keyword-index">

    <p>
        <?= Html::a('添加 Request Keyword', ['create'], ['class' => 'btn btn-success']) ?>
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
           'keyword',
           'times:datetime',
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
               ],
                'template' => ' {view} {update}{delete} ',
            ]
        ],
    ]);
    ?>
    </div>
</div>