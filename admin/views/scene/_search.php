<?php

use yii\helpers\Html;
use zc\gii\bs3activeform\ActiveForm;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\SceneSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-default scene-search">

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

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'describtion') ?>

    <?= $form->field($model, 'subscribeNumber') ?>

    <?= $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'expireSeconds') ?>

    <?php // echo $form->field($model, 'sceneId') ?>

    <?php // echo $form->field($model, 'Ticket') ?>

    <?php // echo $form->field($model, 'TicketTime') ?>

    <?php // echo $form->field($model, 'isCreated') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
