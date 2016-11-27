<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\EventLocation */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Event Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-location-view">

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
       'ToUserName',
       'FromUserName',
       'CreateTime:datetime',
       'MsgType',
       'Event',
       'Latitude',
       'Longitude',
       'Precision',
                       'created_at:datetime',
             ],
    ]) ?>

</div>
