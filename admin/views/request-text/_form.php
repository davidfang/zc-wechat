<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\RequestText */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="request-text-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ToUserName')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'FromUserName')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'CreateTime')->widget(
        trntv\filekit\widget\Upload::className(),
        [
            'url' => ['/file-storage/upload'],
            'maxFileSize' => 2000000, // 2 MiB
        ]); ?>

    <?= $form->field($model, 'MsgType')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'Content')->textInput(['maxlength' => 500]) ?>

    <?= $form->field($model, 'MsgId')->textInput(['maxlength' => 64]) ?>

    <?php //= $form->field($model, 'created_at')->widget(\kartik\date\DatePicker::className(),
            ['pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
            ]
        ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
