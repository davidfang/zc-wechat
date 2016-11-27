<?php

namespace zc\wechat\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * "wx_error_log"表的model
 *
 * @property integer $id
 * @property string $ErrCode
 * @property string $ErrMsg
 * @property string $file
 * @property string $line_code
 * @property string $created_at
 */
class ErrorLog extends \yii\db\ActiveRecord
{
    

        
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_error_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ErrCode', 'ErrMsg', 'file', 'line_code'], 'required'],
            [[ 'created_at'], 'safe'],
            [['ErrCode', 'ErrMsg'], 'string', 'max' => 10000],
            [['file', 'line_code'], 'string', 'max' => 255]
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
                                [
                'class' => \trntv\filekit\behaviors\UploadBehavior::className(),
                'attribute' => '',
                'pathAttribute' => 'file',
                'baseUrlAttribute' => 'base_url' //默认的基本URL
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
            'file',// '文件',
            'line_code',// '可能所有行代码',
            'created_at',// 'Created At',
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
            'file' => '文件',
            'line_code' => '可能所有行代码',
            'created_at' => 'Created At',
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
