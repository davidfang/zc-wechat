<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use zc\wechat\models\Wechat;
/* @var $this yii\web\View */
/* @var $model zc\wechat\models\ResponseKeyword */
/* @var $form yii\bootstrap\ActiveForm */
?>
<?php

$wechats = ArrayHelper::map(Wechat::getOnWechats(), 'id', 'name');
?>
<div class="response-keyword-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'wechat_id')->dropDownList($wechats, ['prompt' => '请选择']) ?>

    <?= $form->field($model, 'keyword')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'type')->dropDownList($model->options['type'], ['prompt' => '请选择']) ?>

    <?= $form->field($model, 'priority')->textInput(['maxlength' => 2]) ?>

    <?= $form->field($model, 'times')->textInput(['maxlength' => 10]) ?>

    <?php /*= $form->field($model, 'created_at')->widget(\kartik\date\DatePicker::className(),
            ['pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
            ]
        ])*/ ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
