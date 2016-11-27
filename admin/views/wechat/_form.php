<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\Wechat */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="wechat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'token')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'access_token')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'account')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'original')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'type_d')->dropDownList($model->options['type_d'], ['prompt' => '请选择']) ?>

    <?= $form->field($model, 'appID')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'secret')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'encoding_aes_key')->textInput(['maxlength' => 43]) ?>

    <?= $form->field($model, 'avatar')->widget(
        trntv\filekit\widget\Upload::className(),
        [
            'url' => ['/file-storage/upload'],
            'maxFileSize' => 2000000, // 2 MiB
        ]); ?>

    <?= $form->field($model, 'qrcode')->widget(
        trntv\filekit\widget\Upload::className(),
        [
            'url' => ['/file-storage/upload'],
            'maxFileSize' => 2000000, // 2 MiB
        ]); ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'status_d')->dropDownList($model->options['status_d'], ['prompt' => '请选择']) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 32]) ?>

    <?php //= $form->field($model, 'created_at')->textInput(['maxlength' => 11]) ?>

    <?php //= $form->field($model, 'updated_at')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'adddate')->widget(\kartik\date\DatePicker::className(),
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
