<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\CurlLog */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="curl-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'queryUrl')->textInput(['maxlength' => 500]) ?>

    <?= $form->field($model, 'param')->textInput(['maxlength' => 1500]) ?>

    <?= $form->field($model, 'method')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'is_json')->textInput(['maxlength' => 5]) ?>

    <?= $form->field($model, 'is_urlcode')->textInput(['maxlength' => 5]) ?>

    <?= $form->field($model, 'ret')->textInput(['maxlength' => 10000]) ?>

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
