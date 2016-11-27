<?php

use yii\helpers\Html;
use zc\gii\bs3activeform\ActiveForm;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\EventMenuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-default event-menu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-inline'],
        'fieldConfig' => [
            'template' => " {label}\n <div class='col-sm-7'>{input}</div>",
            'labelOptions' => ['class' => 'col-lg-4 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ToUserName') ?>

    <?= $form->field($model, 'FromUserName') ?>

    <?= $form->field($model, 'CreateTime') ?>

    <?= $form->field($model, 'MsgType') ?>

    <?php // echo $form->field($model, 'Event') ?>

    <?php // echo $form->field($model, 'EventKey') ?>

    <?php // echo $form->field($model, 'MenuID') ?>

    <?php // echo $form->field($model, 'ScanCodeInfo') ?>

    <?php // echo $form->field($model, 'ScanType') ?>

    <?php // echo $form->field($model, 'ScanResult') ?>

    <?php // echo $form->field($model, 'SendPicsInfo') ?>

    <?php // echo $form->field($model, 'Count') ?>

    <?php // echo $form->field($model, 'PicList') ?>

    <?php // echo $form->field($model, 'PicMd5Sum') ?>

    <?php // echo $form->field($model, 'SendLocationInfo') ?>

    <?php // echo $form->field($model, 'Location_X') ?>

    <?php // echo $form->field($model, 'Location_Y') ?>

    <?php // echo $form->field($model, 'Scale') ?>

    <?php // echo $form->field($model, 'Label') ?>

    <?php // echo $form->field($model, 'PoiName') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
