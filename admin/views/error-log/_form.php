<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\ErrorLog */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="error-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ErrCode')->textInput(['maxlength' => 10000]) ?>

    <?= $form->field($model, 'ErrMsg')->textInput(['maxlength' => 10000]) ?>

    <?= $form->field($model, '')->widget(
        trntv\filekit\widget\Upload::className(),
        [
            'url' => ['/file-storage/upload'],
            'maxFileSize' => 2000000, // 2 MiB
        ]); ?>

    <?= $form->field($model, 'line_code')->textInput(['maxlength' => 255]) ?>

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
