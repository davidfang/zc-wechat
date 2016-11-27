<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\User */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'openid')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'subscribe')->widget(
        trntv\filekit\widget\Upload::className(),
        [
            'url' => ['/file-storage/upload'],
            'maxFileSize' => 2000000, // 2 MiB
        ]); ?>

    <?= $form->field($model, 'nickname')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'sex')->widget(
        trntv\filekit\widget\Upload::className(),
        [
            'url' => ['/file-storage/upload'],
            'maxFileSize' => 2000000, // 2 MiB
        ]); ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'province')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'language')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'headimgurl')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'subscribe_time')->widget(
        trntv\filekit\widget\Upload::className(),
        [
            'url' => ['/file-storage/upload'],
            'maxFileSize' => 2000000, // 2 MiB
        ]); ?>

    <?= $form->field($model, 'unionid')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'privilege')->textInput(['maxlength' => 1000]) ?>

    <?php //= $form->field($model, 'created_at')->widget(
        trntv\filekit\widget\Upload::className(),
        [
            'url' => ['/file-storage/upload'],
            'maxFileSize' => 2000000, // 2 MiB
        ]); ?>

    <?php //= $form->field($model, 'updated_at')->widget(
        trntv\filekit\widget\Upload::className(),
        [
            'url' => ['/file-storage/upload'],
            'maxFileSize' => 2000000, // 2 MiB
        ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
