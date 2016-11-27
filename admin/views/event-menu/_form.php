<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\EventMenu */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="event-menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ToUserName')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'FromUserName')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'CreateTime')->widget(
        trntv\filekit\widget\Upload::className(),
        [
            'url' => ['/file-storage/upload'],
            'maxFileSize' => 2000000, // 2 MiB
        ]); ?>

    <?= $form->field($model, 'MsgType')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'Event')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'EventKey')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'MenuID')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'ScanCodeInfo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ScanType')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'ScanResult')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'SendPicsInfo')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'Count')->widget(
        trntv\filekit\widget\Upload::className(),
        [
            'url' => ['/file-storage/upload'],
            'maxFileSize' => 2000000, // 2 MiB
        ]); ?>

    <?= $form->field($model, 'PicList')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'PicMd5Sum')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'SendLocationInfo')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'Location_X')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'Location_Y')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'Scale')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'Label')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'PoiName')->textInput(['maxlength' => 20]) ?>

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
