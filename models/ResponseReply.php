<?php

namespace zc\wechat\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * "wx_response_reply"表的model
 *
 * @property string $id
 * @property integer $wechat_id
 * @property string $keyword
 * @property string $type
 * @property string $title
 * @property string $url
 * @property string $description
 * @property string $img_banner
 * @property string $img_icon
 * @property string $musicurl
 * @property string $hqmusicurl
 * @property string $ThumbMediaId
 * @property string $voice
 * @property string $video
 * @property string $img_picture
 * @property string $MediaId
 * @property integer $priority
 * @property integer $show_times
 * @property integer $created_at
 */
class ResponseReply extends \yii\db\ActiveRecord
{

    /**
     * @var array
     */

    public $banner;

    /**
     * @var array
     */

    public $icon;

    /**
     * @var array
     */

    public $picture;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_response_reply}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wechat_id', 'keyword', 'title'], 'required'],
            [['type'], 'string'],
            [['banner', 'icon', 'picture', 'created_at'], 'safe'],
            [['wechat_id', 'priority', 'show_times'], 'integer'],
            [['keyword'], 'string', 'max' => 50],
            [['title', 'url', 'MediaId'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 10000],
            [['img_banner', 'img_icon', 'musicurl', 'hqmusicurl', 'ThumbMediaId', 'voice', 'video', 'img_picture'], 'string', 'max' => 200]
        ];
    }

    /**
     * 设置自动创建和更新时间的操作
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],//可以根据需要去掉updated_at
                    //ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],//可以根据需要去掉updated_at
                ],
            ],
            [
                'class' => \trntv\filekit\behaviors\UploadBehavior::className(),
                'attribute' => 'banner',
                'pathAttribute' => 'img_banner',
                'baseUrlAttribute' => 'base_url' //默认的基本URL
            ],
            [
                'class' => \trntv\filekit\behaviors\UploadBehavior::className(),
                'attribute' => 'icon',
                'pathAttribute' => 'img_icon',
                'baseUrlAttribute' => 'base_url' //默认的基本URL
            ],
            [
                'class' => \trntv\filekit\behaviors\UploadBehavior::className(),
                'attribute' => 'picture',
                'pathAttribute' => 'img_picture',
                'baseUrlAttribute' => 'base_url' //默认的基本URL
            ],
            [
                'class' => \zc\wechat\behaviors\ImageBehavior::className(),
                //'attribute' => 'picture',
                //'pathAttribute' => 'img_picture',
                //'baseUrlAttribute' => 'base_url' //默认的基本URL
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
            'title',// '标题(图文)',
            'url',// '网址链接(图文)',
            'description',// '内容(图文|文本)',
            'img_banner',// 'banner图片(图文)',
            'banner',// 'banner图片(图文)',
            'img_icon',// '小图标(图文)',
            'icon',// '小图标(图文)',
            'musicurl',// '音乐(音乐)',
            'hqmusicurl',// '高质量音乐链接，WIFI环境优先使用该链接播放音乐',
            'ThumbMediaId',// '缩略图的媒体id，通过上传多媒体文件，得到的id',
            'voice',// '音频(音频)',
            'video',// '视频(视频)',
            'img_picture',// '图片(图片)',
            'picture',// '图片(图片)',
            'MediaId',// '通过上传多媒体文件，得到的id',
            'priority',// '优先级（排序）',
            'show_times',// '展示次数',
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
            'title' => '标题(图文)',
            'url' => '网址链接(图文)',
            'description' => '内容(图文|文本)',
            'img_banner' => 'banner图片(图文)',
            'banner' => 'banner图片(图文)',
            'img_icon' => '小图标(图文)',
            'icon' => '小图标(图文)',
            'musicurl' => '音乐(音乐)',
            'hqmusicurl' => '高质量音乐链接，WIFI环境优先使用该链接播放音乐',
            'ThumbMediaId' => '缩略图的媒体id，通过上传多媒体文件，得到的id',
            'voice' => '音频(音频)',
            'video' => '视频(视频)',
            'img_picture' => '图片(图片)',
            'picture' => '图片(图片)',
            'MediaId' => '通过上传多媒体文件，得到的id',
            'priority' => '优先级（排序）',
            'show_times' => '展示次数',
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
                'video' => 'Video',
                'music' => 'Music',
                'voice' => 'Voice',
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
                'name' => $options["type"]["text"],
                'jsfunction' => 'changeStatus',
                'field' => 'type',
                'field_value' => 'text'
            ],
            [
                'name' => $options["type"]["image"],
                'jsfunction' => 'changeStatus',
                'field' => 'type',
                'field_value' => 'image'
            ],
            [
                'name' => $options["type"]["video"],
                'jsfunction' => 'changeStatus',
                'field' => 'type',
                'field_value' => 'video'
            ],
            [
                'name' => $options["type"]["music"],
                'jsfunction' => 'changeStatus',
                'field' => 'type',
                'field_value' => 'music'
            ],
            [
                'name' => $options["type"]["voice"],
                'jsfunction' => 'changeStatus',
                'field' => 'type',
                'field_value' => 'voice'
            ],
            [
                'name' => $options["type"]["news"],
                'jsfunction' => 'changeStatus',
                'field' => 'type',
                'field_value' => 'news'
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
}
