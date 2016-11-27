<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use zc\wechat\models\ResponseKeyword;
use zc\wechat\models\ResponseReply;
/* @var $this yii\web\View */
/* @var $searchModel zc\wechat\models\ResponseKeyValueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Response Key Values';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php

$keyword = ArrayHelper::map(ResponseKeyword::find()->all(), 'id', 'keyword');
$reply = ArrayHelper::map(ResponseReply::find()->all(), 'id', 'keyword');

?>
<div class="response-key-value-index">

    <p>
        <?= Html::a('添加 Response Key Value', ['create'], ['class' => 'btn btn-success']) ?>
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
           //'keyword_id',
           //'reply_id',

            [
                'attribute' => 'keyword_id',
                'format' => 'html',
                'value' => function ($model) {
                    $class = 'label-success';
                    $class = 'label-warning';
                    $class = 'label-danger';
                    $class = 'label-info';

                    return '<span class="label ' . $class . '">' . ($model->keyWord->keyword) . '</span>';
                },
                'options' => ['style' => 'width:90px;'],
                'filter' => Html::activeDropDownList($searchModel,
                                    'keyword_id',$keyword,
                                    ['prompt'=>'全部']
                                ),
            ],
            [
                'attribute' => 'reply_id',
                'format' => 'html',
                'value' => function ($model) {
                    $class = 'label-success';
                    $class = 'label-warning';
                    $class = 'label-danger';
                    $class = 'label-info';

                    return '<span class="label ' . $class . '">' . ($model->keyReply->keyword .'--'.mb_substr($model->keyReply->title,0,5,'UTF-8')) . '</span>';
                },
                'options' => ['style' => 'width:90px;'],
                'filter' => Html::activeDropDownList($searchModel,
                                    'reply_id',$reply,
                                    ['prompt'=>'全部']
                                ),
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