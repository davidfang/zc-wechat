<?php

namespace zc\wechat\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * "wx_event_location"表的model
 *
 * @property integer $id
 * @property string $ToUserName
 * @property string $FromUserName
 * @property integer $CreateTime
 * @property string $MsgType
 * @property string $Event
 * @property double $Latitude
 * @property double $Longitude
 * @property double $Precision
 * @property string $created_at
 */
class EventLocation extends \yii\db\ActiveRecord
{
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_event_location}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ToUserName', 'FromUserName', 'CreateTime', 'MsgType', 'Latitude', 'Longitude', 'Precision'], 'required'],
            [['CreateTime'], 'integer'],
            [['Latitude', 'Longitude', 'Precision'], 'string'],
            [['created_at'], 'safe'],
            [['ToUserName', 'FromUserName'], 'string', 'max' => 50],
            [['MsgType', 'Event'], 'string', 'max' => 10]
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
            'Event',// '事件类型，LOCATION',
            'Latitude',// '地理位置纬度',
            'Longitude',// '地理位置经度',
            'Precision',// '地理位置精度',
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
            'Event' => '事件类型，LOCATION',
            'Latitude' => '地理位置纬度',
            'Longitude' => '地理位置经度',
            'Precision' => '地理位置精度',
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
