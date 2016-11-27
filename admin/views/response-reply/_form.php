<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\ResponseReply */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="response-reply-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'keyword')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'type')->dropDownList($model->options['type'], ['prompt' => '请选择']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 10000]) ?>

    <?= $form->field($model, 'banner')->widget(
        trntv\filekit\widget\Upload::className(),
        [
            'url' => ['/file-storage/upload'],
            'maxFileSize' => 2000000, // 2 MiB
        ]); ?>

    <?= $form->field($model, 'icon')->widget(
        trntv\filekit\widget\Upload::className(),
        [
            'url' => ['/file-storage/upload'],
            'maxFileSize' => 2000000, // 2 MiB
        ]); ?>

    <?= $form->field($model, 'musicurl')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'hqmusicurl')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'ThumbMediaId')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'voice')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'video')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'picture')->widget(
        trntv\filekit\widget\Upload::className(),
        [
            'url' => ['/file-storage/upload'],
            'maxFileSize' => 2000000, // 2 MiB
        ]); ?>

    <?= $form->field($model, 'MediaId')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'priority')->textInput(['maxlength' => 2]) ?>

    <?= $form->field($model, 'show_times')->textInput(['maxlength' => 8]) ?>

    <?php /*= $form->field($model, 'created_at')->widget(\kartik\date\DatePicker::className(),
            ['pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
            ]
        ]) */?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
