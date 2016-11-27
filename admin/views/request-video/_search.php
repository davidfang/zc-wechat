<?php

use yii\helpers\Html;
use zc\gii\bs3activeform\ActiveForm;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\RequestVideoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-default request-video-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-inline'],
        'fieldConfig' => [
            'template' => " {label}\n <div class='col-sm-7'>{input}</div>",
            'labelOptions' => ['class' => 'col-lg-4 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'ToUserName') ?>

    <?= $form->field($model, 'FromUserName') ?>

    <?= $form->field($model, 'CreateTime') ?>

    <?= $form->field($model, 'MsgType') ?>

    <?= $form->field($model, 'MediaId') ?>

    <?php // echo $form->field($model, 'ThumbMediaId') ?>

    <?php // echo $form->field($model, 'MsgId') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
