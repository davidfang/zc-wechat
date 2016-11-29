<?php

namespace zc\wechat\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * "wx_scene"表的model
 *
 * @property integer $id
 * @property integer $wechat_id
 * @property string $name
 * @property string $describtion
 * @property integer $subscribeNumber
 * @property string $type
 * @property integer $expireSeconds
 * @property integer $sceneId
 * @property string $Ticket
 * @property string $TicketTime
 * @property string $isCreated
 * @property string $url
 * @property integer $created_at
 * @property integer $updated_at
 */
class Scene extends \yii\db\ActiveRecord
{
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_scene}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wechat_id', 'name', 'sceneId'], 'required'],
            [['wechat_id', 'subscribeNumber', 'expireSeconds', 'sceneId', 'created_at', 'updated_at'], 'integer'],
            [['type', 'isCreated'], 'string'],
            [['TicketTime'], 'safe'],
            [['name', 'describtion', 'Ticket', 'url'], 'string', 'max' => 255]
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
            'wechat_id',// '微信公众号ID',
            'name',// '场景名称',
            'describtion',// '场景简介',
            'subscribeNumber',// '场景关注人数',
            'type',// '类型，临时二维码类型为1，永久二维码类型为2',
            'expireSeconds',// '过期时间，只在类型为临时二维码时有效。最大为1800秒',
            'sceneId',// '场景值ID，临时二维码时为32位非0整型，永久二维码时最大值为100000（目前参数只支持1--100000)',
            'Ticket',// 'Ticket',
            'TicketTime',// '二维码生成时间',
            'isCreated',// '是否生成二维码',
            'url',// '二维码地址',
            'created_at',// '建立时间',
            'updated_at',// '更新时间',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'wechat_id' => '微信公众号',
            'name' => '场景名称',
            'describtion' => '场景简介',
            'subscribeNumber' => '场景关注人数',
            'type' => '类型(临时1，永久2)',
            'expireSeconds' => '过期时间(临时二维码时有效,最大1800秒)',
            'sceneId' => '场景值ID，临时二维码时为32位非0整型，永久二维码时最大值为100000（目前参数只支持1--100000)',
            'Ticket' => 'Ticket',
            'TicketTime' => '二维码生成时间',
            'isCreated' => '是否生成',
            'url' => '二维码地址',
            'created_at' => '建立时间',
            'updated_at' => '更新时间',
        ];
    }

    /**
     * 多选项配置
     * @return array
     */
    public function getOptions()
    {
          return [
    'type' => [
        1 => '临时',
        2 => '永久',
    ],
    'isCreated' => [
        1 => '生成',
        0 => '未生成',
    ],
];
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
                    /*[
                'name'=>$options["type"]["1"],
                'jsfunction'=>'changeStatus',
                'field'=>'type',
                'field_value'=>'1'
                ],
                [
                'name'=>$options["type"]["2"],
                'jsfunction'=>'changeStatus',
                'field'=>'type',
                'field_value'=>'2'
                ],*/
                [
                'name'=>$options["isCreated"]["1"],
                'jsfunction'=>'changeStatus',
                'field'=>'isCreated',
                'field_value'=>'1'
                ],/*
                [
                'name'=>$options["isCreated"]["0"],
                'jsfunction'=>'changeStatus',
                'field'=>'isCreated',
                'field_value'=>'0'
                ],*/
        ];
    }
    /**
     * 获取微信号
     * 取的时候使用
     * $wechat = models\Wechat::findOne(1);
     * $wechatName = $wechat->name;
     */
    public function getWechat(){
        return $this->hasOne(Wechat::className(),['id'=>'wechat_id']);//->asArray();
    }
}
