<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use zc\wechat\models\Wechat;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\Scene */
/* @var $form yii\bootstrap\ActiveForm */
?>
<?php

$wechats = ArrayHelper::map(Wechat::getOnWechats(), 'id', 'name');
?>

<div class="scene-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'wechat_id')->dropDownList($wechats, ['prompt' => '请选择'])  ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'describtion')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'subscribeNumber')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'type')->dropDownList($model->options['type'], ['prompt' => '请选择']) ?>

    <?= $form->field($model, 'expireSeconds')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'sceneId')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'Ticket')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'TicketTime')->widget(\kartik\date\DatePicker::className(),
            ['pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
            ]
        ]) ?>

    <?= $form->field($model, 'isCreated')->dropDownList($model->options['isCreated'], ['prompt' => '请选择']) ?>

    <?php //= $form->field($model, 'created_at')->textInput(['maxlength' => 11]) ?>

    <?php //= $form->field($model, 'updated_at')->textInput(['maxlength' => 11]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
