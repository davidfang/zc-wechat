<?php

namespace zc\wechat\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * "wx_response_keyword"表的model
 *
 * @property integer $id
 * @property integer $wechat_id
 * @property string $keyword
 * @property string $type
 * @property integer $priority
 * @property integer $times
 * @property integer $created_at
 */
class ResponseKeyword extends \yii\db\ActiveRecord
{
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_response_keyword}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wechat_id','keyword'], 'required'],
            [['type'], 'string'],
            [['priority', 'times'], 'integer'],
            [['created_at'], 'safe'],
            [['keyword'], 'string', 'max' => 50]
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
                        ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],//可以根据需要去掉updated_at
                        //ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],//可以根据需要去掉updated_at
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
            'wechat_id',// '微信公众号ID（数据库）',
            'keyword',// '关键词',
            'type',// '回复类型',
            'priority',// '优先级',
            'times',// '命中次数',
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
            'wechat_id' => '微信公众号ID（数据库）',
            'keyword' => '关键词',
            'type' => '回复类型',
            'priority' => '优先级',
            'times' => '命中次数',
            'created_at' => '建立时间',
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
                'text' => 'Text',
                'image' => 'Image',
                'voice' => 'Voice',
                'video' => 'Video',
                'music' => 'Music',
                'news' => 'News',
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
            [
                'name'=>$options["type"]["text"],
                'jsfunction'=>'changeStatus',
                'field'=>'type',
                'field_value'=>'text'
            ],
            [
                'name'=>$options["type"]["image"],
                'jsfunction'=>'changeStatus',
                'field'=>'type',
                'field_value'=>'image'
            ],
            [
                'name'=>$options["type"]["voice"],
                'jsfunction'=>'changeStatus',
                'field'=>'type',
                'field_value'=>'voice'
            ],
            [
                'name'=>$options["type"]["video"],
                'jsfunction'=>'changeStatus',
                'field'=>'type',
                'field_value'=>'video'
            ],
            [
                'name'=>$options["type"]["music"],
                'jsfunction'=>'changeStatus',
                'field'=>'type',
                'field_value'=>'music'
            ],
            [
                'name'=>$options["type"]["news"],
                'jsfunction'=>'changeStatus',
                'field'=>'type',
                'field_value'=>'news'
            ],
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
    /**
     * 获取关键词对应的回复值
     * 取的时候使用
     * $keyword = models\ResponseKeyword::findOne(1);
     * $keyvalue = $keyword->keyValue;
     */
    public function getKeyValue(){
        //return $this->hasOne(ResponseKeyvalue::className(),['keyword_id'=>'id']);//->asArray();
        //->inverseOf('{{%wx_response_key_value}}')证明两个表是反向关系
        return $this->hasMany(ResponseKeyvalue::className(),['keyword_id'=>'id'])->inverseOf('keyWord');//->asArray();
    }
    /**
     * 获取对应一条回复信息（不适合多图文回复）
     * @return mixed
     */
    public function getReply(){
        return $this->hasOne(ResponseReply::className(),['id'=>'reply_id'])->viaTable('{{%wx_response_key_value}}',['keyword_id'=>'id'])->where('type = :type', [':type' => $this->type])->orderBy('priority');//->asArray();
    }
    /**
     * 获取对应回复信息
     * @return mixed
     */
    public function getReplys(){
        return $this->hasMany(ResponseReply::className(),['id'=>'reply_id'])->viaTable('{{%wx_response_key_value}}',['keyword_id'=>'id'])->where('type = :type', [':type' => $this->type])->orderBy('priority');//->asArray();
    }
}
