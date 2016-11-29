<?php

namespace zc\wechat\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * "wx_menu"表的model
 *
 * @property integer $id
 * @property integer $wechat_id
 * @property integer $pid
 * @property string $name
 * @property string $type
 * @property string $code
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $status
 */
class Menu extends \yii\db\ActiveRecord
{
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wechat_id','pid', 'name'], 'required'],
            [['wechat_id', 'pid', 'created_at', 'updated_at'], 'integer'],
            [['type', 'status'], 'string'],
            [['name'], 'string', 'max' => 40],
            [['code'], 'string', 'max' => 256]
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
            'pid',// '该分类的上级分类，顶级分类则填写0',
            'name',// '菜单标题，不超过16个字节，子菜单不超过40个字节',
            'type',// '菜单的响应动作类型',
            'code',// '是view类型的URL或者其他类型的自定义key，如果该分类下有子分类请务必留空。',
            'created_at',// '建立时间',
            'updated_at',// '更新时间',
            'status',// '是否使用',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'wechat_id' => '公众号',
            'pid' => '上级分类',
            'name' => '菜单标题',
            'type' => '菜单类型',
            'code' => '是view类型的URL或者其他类型的自定义key，如果该分类下有子分类请务必留空。',
            'created_at' => '建立时间',
            'updated_at' => '更新时间',
            'status' => '是否使用',
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
        'click' => '点击推事件',
        'view' => '跳转URL',
        'scancode_push' => '扫码推事件',
        'scancode_waitmsg' => '扫码推事件且弹出“消息接收中”提示框',
        'pic_sysphoto' => '弹出系统拍照发图',
        'pic_photo_or_album' => '弹出拍照或者相册发图',
        'pic_weixin' => '弹出微信相册发图器',
        'location_select' => '弹出地理位置选择器',
        '' => '顶级',
    ],
    'status' => [
        '1' => '启用',
        '0' => '暂停',
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
                'name'=>$options["type"]["click"],
                'jsfunction'=>'changeStatus',
                'field'=>'type',
                'field_value'=>'click'
                ],
                [
                'name'=>$options["type"]["view"],
                'jsfunction'=>'changeStatus',
                'field'=>'type',
                'field_value'=>'view'
                ],
                [
                'name'=>$options["type"]["scancode_push"],
                'jsfunction'=>'changeStatus',
                'field'=>'type',
                'field_value'=>'scancode_push'
                ],
                [
                'name'=>$options["type"]["scancode_waitmsg"],
                'jsfunction'=>'changeStatus',
                'field'=>'type',
                'field_value'=>'scancode_waitmsg'
                ],
                [
                'name'=>$options["type"]["pic_sysphoto"],
                'jsfunction'=>'changeStatus',
                'field'=>'type',
                'field_value'=>'pic_sysphoto'
                ],
                [
                'name'=>$options["type"]["pic_photo_or_album"],
                'jsfunction'=>'changeStatus',
                'field'=>'type',
                'field_value'=>'pic_photo_or_album'
                ],
                [
                'name'=>$options["type"]["pic_weixin"],
                'jsfunction'=>'changeStatus',
                'field'=>'type',
                'field_value'=>'pic_weixin'
                ],
                [
                'name'=>$options["type"]["location_select"],
                'jsfunction'=>'changeStatus',
                'field'=>'type',
                'field_value'=>'location_select'
                ],
                [
                'name'=>$options["type"][""],
                'jsfunction'=>'changeStatus',
                'field'=>'type',
                'field_value'=>''
                ],*/
                [
                'name'=>$options["status"]["1"],
                'jsfunction'=>'changeStatus',
                'field'=>'status',
                'field_value'=>'1'
                ],
                [
                'name'=>$options["status"]["0"],
                'jsfunction'=>'changeStatus',
                'field'=>'status',
                'field_value'=>'0'
                ],
        ];
    }

    /**
     * 获取所有菜单
     * @return array
     */
    public static function getAllParents(){
        $result = self::find()->orderBy('pid')->all();
        $return = ArrayHelper::map($result,'id','name','pid');
       return [0=>'顶级'] + $return;
        if($group){
            return ArrayHelper::map($result,'id','name','pid');
        }else{
            $return = ArrayHelper::map($result,'id','name');
            //array_unshift($return,'顶级');
            return [0=>'顶级'] + $return;
        }
    }

    /**
     * 获取上级菜单名字
     */
    static public function getParentName($pid){
        if($pid == 0){
           return '顶级';
        }else{
            return self::findOne($pid)->name;
        }
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
