<?php

namespace zc\wechat\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * "wx_request_video"表的model
 *
 * @property string $ToUserName
 * @property string $FromUserName
 * @property integer $CreateTime
 * @property string $MsgType
 * @property string $MediaId
 * @property string $ThumbMediaId
 * @property string $MsgId
 * @property string $created_at
 */
class RequestVideo extends \yii\db\ActiveRecord
{
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_request_video}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ToUserName', 'FromUserName', 'CreateTime', 'MsgType', 'MediaId', 'ThumbMediaId', 'MsgId'], 'required'],
            [['CreateTime'], 'integer'],
            [['created_at'], 'safe'],
            [['ToUserName', 'FromUserName'], 'string', 'max' => 50],
            [['MsgType'], 'string', 'max' => 10],
            [['MediaId', 'ThumbMediaId'], 'string', 'max' => 100],
            [['MsgId'], 'string', 'max' => 64]
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
            'ToUserName',// '开发者微信号',
            'FromUserName',// '发送方帐号（一个OpenID）',
            'CreateTime',// '消息创建时间 （整型）',
            'MsgType',// '视频为video',
            'MediaId',// '视频消息媒体id，可以调用多媒体文件下载接口拉取数据。',
            'ThumbMediaId',// '视频消息缩略图的媒体id，可以调用多媒体文件下载接口拉取数据。',
            'MsgId',// '消息id，64位整型',
            'created_at',// '建立时间',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ToUserName' => '开发者微信号',
            'FromUserName' => '发送方帐号（一个OpenID）',
            'CreateTime' => '消息创建时间 （整型）',
            'MsgType' => '视频为video',
            'MediaId' => '视频消息媒体id，可以调用多媒体文件下载接口拉取数据。',
            'ThumbMediaId' => '视频消息缩略图的媒体id，可以调用多媒体文件下载接口拉取数据。',
            'MsgId' => '消息id，64位整型',
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
