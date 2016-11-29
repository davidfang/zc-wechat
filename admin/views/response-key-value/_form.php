<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use zc\wechat\models\ResponseKeyword;
use zc\wechat\models\ResponseReply;
use zc\wechat\models\Wechat;
/* @var $this yii\web\View */
/* @var $model zc\wechat\models\ResponseKeyValue */
/* @var $form yii\bootstrap\ActiveForm */
?>
<?php

    $wechats = ArrayHelper::map(Wechat::getOnWechats(), 'id', 'name');
    $keyword = ArrayHelper::map(ResponseKeyword::find()->all(), 'id', 'keyword');
    $responseReplyAll = ResponseReply::find()->all();
    $replyKey = ArrayHelper::getColumn($responseReplyAll, 'id');
    $replyValue = ArrayHelper::getColumn($responseReplyAll, function ($element) {
            return $element['keyword'] .'--'. mb_substr($element['title'],0,5,'UTF-8');
        });
    //$reply = ArrayHelper::map(ResponseReply::find()->all(), 'id', 'keyword');
    $reply = array_combine($replyKey,$replyValue);

?>
<div class="response-key-value-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'wechat_id')->dropDownList($wechats, ['prompt' => '请选择']) ?>

    <?= $form->field($model, 'keyword_id')->dropDownList($keyword, ['prompt' => '请选择']) ?>

    <?= $form->field($model, 'reply_id')->dropDownList($reply, ['prompt' => '请选择']) ?>

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
