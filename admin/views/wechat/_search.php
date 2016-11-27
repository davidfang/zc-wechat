<?php

use yii\helpers\Html;
use zc\gii\bs3activeform\ActiveForm;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\WechatSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-default wechat-search">

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

    <?= $form->field($model, 'token') ?>

    <?= $form->field($model, 'access_token') ?>

    <?= $form->field($model, 'account') ?>

    <?php // echo $form->field($model, 'original') ?>

    <?php // echo $form->field($model, 'type_d')->dropDownList($model->options['type_d'], ['prompt' => '请选择']) ?>

    <?php // echo $form->field($model, 'appID') ?>

    <?php // echo $form->field($model, 'secret') ?>

    <?php // echo $form->field($model, 'encoding_aes_key') ?>

    <?php // echo $form->field($model, 'base_url') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'username') ?>

    <?php // echo $form->field($model, 'status_d')->dropDownList($model->options['status_d'], ['prompt' => '请选择']) ?>

    <?php // echo $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'adddate') ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
