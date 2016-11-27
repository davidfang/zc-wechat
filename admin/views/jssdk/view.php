<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\Jssdk */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jssdks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jssdk-view">

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
       'ErrCode',
       'ErrMsg',
       'JsApiTicket',
       'expire_time:datetime',
                       'created_at:datetime',
             ],
    ]) ?>

</div>
