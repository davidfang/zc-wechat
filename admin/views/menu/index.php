<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use zc\wechat\models\Wechat;
use zc\wechat\models\Menu;

/* @var $this yii\web\View */
/* @var $searchModel zc\wechat\models\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$wechats = ArrayHelper::map(Wechat::getOnWechats(), 'id', 'name');

?>
<div class="menu-index">

    <p>
        <?= Html::a('添加 Menu', ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute' => 'pid',
                'format' => 'html',
                'value' => function ($model) {

                    return Menu::getParentName($model->pid);
                },
                'options' => ['style' => 'width:90px;'],
                'filter' => Html::activeDropDownList($searchModel,
                    'pid',
                    Menu::getAllParents(),
                    ['prompt'=>'请选择']
                    ),
            ],
           'name',
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
                       //'code',
 [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function ($model) {
                    $class = 'label-success';
                    $class = 'label-warning';
                    $class = 'label-danger';
                    $class = 'label-info';
                    return '<span class="label ' . $class . '">' . ($model->options['status'][$model->status]) . '</span>';
                },
                'options' => ['style' => 'width:90px;'],
                'filter' => $searchModel->options['status'],
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
                    'type_click' => function ($url, $model, $key) {
                        return $model->type == 'click' ? '' : Html::button('点击推事件', ['class' => 'btn btn-primary btn-sm', 'onclick' => "javascript:changeStatus('type','click','{$model->id}');"]);
                    },
                    'type_view' => function ($url, $model, $key) {
                        return $model->type == 'view' ? '' : Html::button('跳转URL', ['class' => 'btn btn-primary btn-sm', 'onclick' => "javascript:changeStatus('type','view','{$model->id}');"]);
                    },
                    'type_scancode_push' => function ($url, $model, $key) {
                        return $model->type == 'scancode_push' ? '' : Html::button('扫码推事件', ['class' => 'btn btn-primary btn-sm', 'onclick' => "javascript:changeStatus('type','scancode_push','{$model->id}');"]);
                    },
                    'type_scancode_waitmsg' => function ($url, $model, $key) {
                        return $model->type == 'scancode_waitmsg' ? '' : Html::button('扫码推事件且弹出“消息接收中”提示框', ['class' => 'btn btn-primary btn-sm', 'onclick' => "javascript:changeStatus('type','scancode_waitmsg','{$model->id}');"]);
                    },
                    'type_pic_sysphoto' => function ($url, $model, $key) {
                        return $model->type == 'pic_sysphoto' ? '' : Html::button('弹出系统拍照发图', ['class' => 'btn btn-primary btn-sm', 'onclick' => "javascript:changeStatus('type','pic_sysphoto','{$model->id}');"]);
                    },
                    'type_pic_photo_or_album' => function ($url, $model, $key) {
                        return $model->type == 'pic_photo_or_album' ? '' : Html::button('弹出拍照或者相册发图', ['class' => 'btn btn-primary btn-sm', 'onclick' => "javascript:changeStatus('type','pic_photo_or_album','{$model->id}');"]);
                    },
                    'type_pic_weixin' => function ($url, $model, $key) {
                        return $model->type == 'pic_weixin' ? '' : Html::button('弹出微信相册发图器', ['class' => 'btn btn-primary btn-sm', 'onclick' => "javascript:changeStatus('type','pic_weixin','{$model->id}');"]);
                    },
                    'type_location_select' => function ($url, $model, $key) {
                        return $model->type == 'location_select' ? '' : Html::button('弹出地理位置选择器', ['class' => 'btn btn-primary btn-sm', 'onclick' => "javascript:changeStatus('type','location_select','{$model->id}');"]);
                    },
                    'type_' => function ($url, $model, $key) {
                        return $model->type == '' ? '' : Html::button('顶级', ['class' => 'btn btn-primary btn-sm', 'onclick' => "javascript:changeStatus('type','','{$model->id}');"]);
                    },
                    'status_1' => function ($url, $model, $key) {
                        return $model->status == '1' ? '' : Html::button('启用', ['class' => 'btn btn-primary btn-sm', 'onclick' => "javascript:changeStatus('status','1','{$model->id}');"]);
                    },
                    'status_0' => function ($url, $model, $key) {
                        return $model->status == '0' ? '' : Html::button('暂停', ['class' => 'btn btn-primary btn-sm', 'onclick' => "javascript:changeStatus('status','0','{$model->id}');"]);
                    },
               ],
                'template' => '{status_1} {status_0}  {view} {update}{delete} ',
            ]
        ],
    ]);
    ?>
    </div>
</div>