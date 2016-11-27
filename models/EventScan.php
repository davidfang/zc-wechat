<?php

namespace zc\wechat\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * "wx_event_scan"表的model
 *
 * @property integer $id
 * @property string $ToUserName
 * @property string $FromUserName
 * @property integer $CreateTime
 * @property string $MsgType
 * @property string $Event
 * @property string $EventKey
 * @property string $Ticket
 * @property string $created_at
 */
class EventScan extends \yii\db\ActiveRecord
{
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_event_scan}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ToUserName', 'FromUserName', 'CreateTime', 'MsgType', 'Event', 'EventKey', 'Ticket'], 'required'],
            [['CreateTime'], 'integer'],
            [['created_at'], 'safe'],
            [['ToUserName', 'FromUserName', 'Ticket'], 'string', 'max' => 50],
            [['MsgType'], 'string', 'max' => 10],
            [['Event'], 'string', 'max' => 15],
            [['EventKey'], 'string', 'max' => 100]
        ];
    }
    /**
    * 设置自动创建和更新时间的操作
    * @inheritdoc
    */
    public function behaviors(){
        return [
                /*[
                    'class' => TimestampBehavior::className(),
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],//可以根据需要去掉updated_at
                        ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],//可以根据需要去掉updated_at
                    ],
                ],*/
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
            'ToUserName',// '开发者微信号',
            'FromUserName',// '发送方帐号（一个OpenID）',
            'CreateTime',// '消息创建时间 （整型）',
            'MsgType',// '消息类型，Event',
            'Event',// '事件类型，subscribe，SCAN',
            'EventKey',// '事件KEY值，qrscene_为前缀，后面为二维码的参数值或者是一个32位无符号整数，即创建二维码时的二维码scene_id',
            'Ticket',// '二维码的Ticket，可用来换取二维码图片',
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
            'ToUserName' => '开发者微信号',
            'FromUserName' => '发送方帐号（一个OpenID）',
            'CreateTime' => '消息创建时间 （整型）',
            'MsgType' => '消息类型，Event',
            'Event' => '事件类型，subscribe，SCAN',
            'EventKey' => '事件KEY值，qrscene_为前缀，后面为二维码的参数值或者是一个32位无符号整数，即创建二维码时的二维码scene_id',
            'Ticket' => '二维码的Ticket，可用来换取二维码图片',
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
