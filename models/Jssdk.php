<?php

namespace zc\wechat\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * "wx_jssdk"表的model
 *
 * @property integer $id
 * @property integer $ErrCode
 * @property string $ErrMsg
 * @property string $JsApiTicket
 * @property integer $expire_time
 * @property string $created_at
 */
class Jssdk extends \yii\db\ActiveRecord
{
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_jssdk}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ErrCode', 'ErrMsg', 'JsApiTicket', 'expire_time'], 'required'],
            [['ErrCode', 'expire_time'], 'integer'],
            [['created_at'], 'safe'],
            [['ErrMsg', 'JsApiTicket'], 'string', 'max' => 255]
        ];
    }
    /**
    * 设置自动创建和更新时间的操作
    * @inheritdoc
    */
    public function behaviors(){
        return [
                [
                    'class' => TimestampBehavior::className(),
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],//可以根据需要去掉updated_at
                        ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],//可以根据需要去掉updated_at
                    ],
                ],
                        ];
    }
    /**
     * 设置列表页显示列和搜索列
     * @inheritdoc
     */
    public function getIndexLists()
    {
        return [
            'id',// 'ID',
            'ErrCode',// 'Err Code',
            'ErrMsg',// 'Err Msg',
            'JsApiTicket',// 'Js Api Ticket',
            'expire_time',// '有效期',
            'created_at',// '建立时间',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ErrCode' => 'Err Code',
            'ErrMsg' => 'Err Msg',
            'JsApiTicket' => 'Js Api Ticket',
            'expire_time' => '有效期',
            'created_at' => '建立时间',
        ];
    }

    /**
     * 多选项配置
     * @return array
     */
    public function getOptions()
    {
          return [];
    }

    /**
     * toolbars工具栏按钮设定
     * 字段为枚举类型时存在
     * 默认为复选项的值，
     * jsfunction默认值为changeStatus
     * @return array
     * 返回值举例：
     * [
     *  ['name'=>'忘却',//名称
     *  'jsfunction'=>'ask',//js操作方法，默认为：changeStatus
     *  'field'=>'status_2',//操作字段名
     *  'field_value'=>'3'],//修改后的值
     *  ]
     */
    public function getToolbars()
    {
        $attributeLabels = $this->attributeLabels();
        $options = $this->options;
        return [
            ];
    }

}
