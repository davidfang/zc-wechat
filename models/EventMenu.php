<?php

namespace zc\wechat\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * "wx_event_menu"表的model
 *
 * @property integer $id
 * @property string $ToUserName
 * @property string $FromUserName
 * @property integer $CreateTime
 * @property string $MsgType
 * @property string $Event
 * @property string $EventKey
 * @property string $MenuID
 * @property string $ScanCodeInfo
 * @property string $ScanType
 * @property string $ScanResult
 * @property string $SendPicsInfo
 * @property integer $Count
 * @property string $PicList
 * @property string $PicMd5Sum
 * @property string $SendLocationInfo
 * @property string $Location_X
 * @property string $Location_Y
 * @property string $Scale
 * @property string $Label
 * @property string $PoiName
 * @property string $created_at
 */
class EventMenu extends \yii\db\ActiveRecord
{
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_event_menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ToUserName', 'FromUserName', 'CreateTime', 'MsgType', 'Event', 'EventKey'], 'required'],
            [['CreateTime', 'Count'], 'integer'],
            [['ScanCodeInfo', 'ScanResult'], 'string'],
            [['created_at'], 'safe'],
            [['ToUserName', 'FromUserName'], 'string', 'max' => 50],
            [['MsgType', 'Event', 'PoiName'], 'string', 'max' => 20],
            [['EventKey', 'MenuID', 'Label'], 'string', 'max' => 100],
            [['ScanType'], 'string', 'max' => 30],
            [['SendPicsInfo', 'PicList'], 'string', 'max' => 255],
            [['PicMd5Sum'], 'string', 'max' => 32],
            [['SendLocationInfo', 'Location_X', 'Location_Y', 'Scale'], 'string', 'max' => 10]
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
            'ToUserName',// '开发者微信号',
            'FromUserName',// '发送方帐号（一个OpenID）',
            'CreateTime',// '消息创建时间 （整型）',
            'MsgType',// '消息类型，Event',
            'Event',// '消息类型，Event',
            'EventKey',// '事件类型，（click、view、scancode_push、scancode_waitmsg、pic_sysphoto、pic_photo_or_album、pic_weixin、location_select）',
            'MenuID',// '指菜单ID，如果是个性化菜单，则可以通过这个字段，知道是哪个规则的菜单被点击了。',
            'ScanCodeInfo',// '扫描信息（scancode_push,scancode_waitmsg）',
            'ScanType',// '扫描类型，一般是qrcode（scancode_push,scancode_waitmsg）',
            'ScanResult',// '扫描结果，即二维码对应的字符串信息（scancode_push,scancode_waitmsg）',
            'SendPicsInfo',// '发送的图片信息(pic_sysphoto、pic_photo_or_album、pic_weixin)',
            'Count',// '发送的图片数量(pic_sysphoto、pic_photo_or_album、pic_weixin)',
            'PicList',// '图片列表(pic_sysphoto、pic_photo_or_album、pic_weixin)',
            'PicMd5Sum',// '图片的MD5值，开发者若需要，可用于验证接收到图片(pic_sysphoto、pic_photo_or_album、pic_weixin)',
            'SendLocationInfo',// '发送的位置信息',
            'Location_X',// 'X坐标信息',
            'Location_Y',// 'Y坐标信息',
            'Scale',// '精度，可理解为精度或者比例尺、越精细的话 Scale越高',
            'Label',// '地理位置的字符串信息',
            'PoiName',// '朋友圈POI的名字，可能为空',
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
            'Event' => '消息类型，Event',
            'EventKey' => '事件类型，（click、view、scancode_push、scancode_waitmsg、pic_sysphoto、pic_photo_or_album、pic_weixin、location_select）',
            'MenuID' => '指菜单ID，如果是个性化菜单，则可以通过这个字段，知道是哪个规则的菜单被点击了。',
            'ScanCodeInfo' => '扫描信息（scancode_push,scancode_waitmsg）',
            'ScanType' => '扫描类型，一般是qrcode（scancode_push,scancode_waitmsg）',
            'ScanResult' => '扫描结果，即二维码对应的字符串信息（scancode_push,scancode_waitmsg）',
            'SendPicsInfo' => '发送的图片信息(pic_sysphoto、pic_photo_or_album、pic_weixin)',
            'Count' => '发送的图片数量(pic_sysphoto、pic_photo_or_album、pic_weixin)',
            'PicList' => '图片列表(pic_sysphoto、pic_photo_or_album、pic_weixin)',
            'PicMd5Sum' => '图片的MD5值，开发者若需要，可用于验证接收到图片(pic_sysphoto、pic_photo_or_album、pic_weixin)',
            'SendLocationInfo' => '发送的位置信息',
            'Location_X' => 'X坐标信息',
            'Location_Y' => 'Y坐标信息',
            'Scale' => '精度，可理解为精度或者比例尺、越精细的话 Scale越高',
            'Label' => '地理位置的字符串信息',
            'PoiName' => '朋友圈POI的名字，可能为空',
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
