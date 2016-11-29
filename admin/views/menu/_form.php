<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use zc\wechat\models\Wechat;
use zc\wechat\models\Menu;

/* @var $this yii\web\View */
/* @var $model zc\wechat\models\Menu */
/* @var $form yii\bootstrap\ActiveForm */
?>
<?php

$wechats = ArrayHelper::map(Wechat::getOnWechats(), 'id', 'name');
$allParents = Menu::getAllParents();
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'wechat_id')->dropDownList($wechats, ['prompt' => '请选择']) ?>

    <?= $form->field($model, 'pid')->dropDownList($allParents, ['prompt' => '请选择'])  ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'type')->dropDownList($model->options['type'], ['prompt' => '请选择']) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => 256]) ?>

    <?= $form->field($model, 'status')->dropDownList($model->options['status'], ['prompt' => '请选择']) ?>

    <?php //= $form->field($model, 'created_at')->textInput(['maxlength' => 11]) ?>

    <?php //= $form->field($model, 'updated_at')->textInput(['maxlength' => 11]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
