<?php

namespace zc\wechat\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * "wx_menu"表的model
 *
 * @property integer $id
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
            [['pid', 'name'], 'required'],
            [['pid', 'created_at', 'updated_at'], 'integer'],
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
            'pid' => '该分类的上级分类，顶级分类则填写0',
            'name' => '菜单标题，不超过16个字节，子菜单不超过40个字节',
            'type' => '菜单的响应动作类型',
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
