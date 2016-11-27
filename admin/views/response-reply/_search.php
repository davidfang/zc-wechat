<?php

use yii\helpers\Html;
use zc\gii\bs3activeform\ActiveForm;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\ResponseReplySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-default response-reply-search">

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

    <?= $form->field($model, 'keyword') ?>

    <?= $form->field($model, 'type')->dropDownList($model->options['type'], ['prompt' => '请选择']) ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'musicurl') ?>

    <?php // echo $form->field($model, 'hqmusicurl') ?>

    <?php // echo $form->field($model, 'ThumbMediaId') ?>

    <?php // echo $form->field($model, 'voice') ?>

    <?php // echo $form->field($model, 'video') ?>

    <?php // echo $form->field($model, 'MediaId') ?>

    <?php // echo $form->field($model, 'priority') ?>

    <?php // echo $form->field($model, 'show_times') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
