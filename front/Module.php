<?php

namespace zc\wechat\front;
use Yii;
/**
 * front module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'zc\wechat\front\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        Yii::$app->user->enableSession = false;
        Yii::$app->user->loginUrl = null;
    }
}
