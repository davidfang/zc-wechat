<?php

namespace zc\wechat\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * "wx_curl_log"表的model
 *
 * @property integer $id
 * @property string $queryUrl
 * @property string $param
 * @property string $method
 * @property string $is_json
 * @property string $is_urlcode
 * @property string $ret
 * @property string $created_at
 */
class CurlLog extends \yii\db\ActiveRecord
{
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_curl_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['queryUrl', 'param', 'method', 'is_json', 'is_urlcode', 'ret'], 'required'],
            [['created_at'], 'safe'],
            [['queryUrl'], 'string', 'max' => 500],
            [['param'], 'string', 'max' => 1500],
            [['method'], 'string', 'max' => 10],
            [['is_json', 'is_urlcode'], 'string', 'max' => 5],
            [['ret'], 'string', 'max' => 10000]
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
            'queryUrl',// '请求地址',
            'param',// '参数',
            'method',// '请求类型',
            'is_json',// 'Is Json',
            'is_urlcode',// 'Is Urlcode',
            'ret',// '返回结果',
            'created_at',// '请求时间',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'queryUrl' => '请求地址',
            'param' => '参数',
            'method' => '请求类型',
            'is_json' => 'Is Json',
            'is_urlcode' => 'Is Urlcode',
            'ret' => '返回结果',
            'created_at' => '请求时间',
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
