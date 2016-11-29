<?php

namespace zc\wechat\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use EasyWeChat\Foundation\Application;
/**
 * "wechat"表的model
 *
 * @property integer $id
 * @property string $name
 * @property string $token
 * @property string $access_token
 * @property string $account
 * @property string $original
 * @property string $type_d
 * @property string $appID
 * @property string $secret
 * @property string $encoding_aes_key
 * @property string $base_url
 * @property string $img_avatar
 * @property string $img_qrcode
 * @property string $address
 * @property string $description
 * @property string $username
 * @property string $status_d
 * @property string $password
 * @property string $created_at
 * @property string $updated_at
 * @property string $adddate
 */
class Wechat extends \yii\db\ActiveRecord
{
    
   /**
    * @var array
    */

    public $avatar;
        
   /**
    * @var array
    */

    public $qrcode;
        
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_wechat}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_d', 'status_d'], 'string'],
            [['avatar', 'qrcode', 'adddate'], 'safe'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'original', 'username'], 'string', 'max' => 40],
            [['token', 'password'], 'string', 'max' => 32],
            [['access_token', 'base_url', 'img_avatar', 'img_qrcode', 'address', 'description'], 'string', 'max' => 255],
            [['account'], 'string', 'max' => 30],
            [['appID', 'secret'], 'string', 'max' => 50],
            [['encoding_aes_key'], 'string', 'max' => 43]
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
                'attribute' => 'avatar',
                'pathAttribute' => 'img_avatar',
                'baseUrlAttribute' => 'base_url' //默认的基本URL
                ],
                                [
                'class' => \trntv\filekit\behaviors\UploadBehavior::className(),
                'attribute' => 'qrcode',
                'pathAttribute' => 'img_qrcode',
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
            'name',// '公众号名称',
            'token',// '微信服务访问验证token',
            'access_token',// '访问微信服务验证token',
            'account',// '微信号',
            'original',// '原始ID',
            'type_d',// '公众号类型',
            'appID',// '公众号的AppID',
            'secret',// '公众号的AppSecret',
            'encoding_aes_key',// '消息加密秘钥EncodingAesKey',
            'base_url',// '图片基本路径',
            'img_avatar',// '头像地址',
            'avatar',// '头像地址',
            'img_qrcode',// '二维码地址',
            'qrcode',// '二维码地址',
            'address',// '所在地址',
            'description',// '公众号简介',
            'username',// '微信官网登录名',
            'status_d',// '状态',
            'password',// '微信官网登录密码',
            'created_at',// '创建时间',
            'updated_at',// '修改时间',
            'adddate',// '添加时间',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '公众号名称',
            'token' => '微信服务访问验证token',
            'access_token' => '访问微信服务验证token',
            'account' => '微信号',
            'original' => '原始ID',
            'type_d' => '公众号类型',
            'appID' => '公众号的AppID',
            'secret' => '公众号的AppSecret',
            'encoding_aes_key' => '消息加密秘钥EncodingAesKey',
            'base_url' => '图片基本路径',
            'img_avatar' => '头像地址',
            'avatar' => '头像地址',
            'img_qrcode' => '二维码地址',
            'qrcode' => '二维码地址',
            'address' => '所在地址',
            'description' => '公众号简介',
            'username' => '微信官网登录名',
            'status_d' => '状态',
            'password' => '微信官网登录密码',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
            'adddate' => '添加时间',
        ];
    }

    /**
     * 多选项配置
     * @return array
     */
    public function getOptions()
    {
          return [
    'type_d' => [
        '1' => '订阅号',
        '2' => '服务号',
        '3' => '小程序',
    ],
    'status_d' => [
        '0'=>'暂停',
        '1'=>'启用',
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
                'name'=>$options["type_d"]["1"],
                'jsfunction'=>'changeStatus',
                'field'=>'type_d',
                'field_value'=>'1'
                ],
                [
                'name'=>$options["type_d"]["2"],
                'jsfunction'=>'changeStatus',
                'field'=>'type_d',
                'field_value'=>'2'
                ],
                [
                'name'=>$options["type_d"]["3"],
                'jsfunction'=>'changeStatus',
                'field'=>'type_d',
                'field_value'=>'3'
                ],
                [
                'name'=>$options["status_d"]["0"],
                'jsfunction'=>'changeStatus',
                'field'=>'status_d',
                'field_value'=>'0'
                ],
                [
                'name'=>$options["status_d"]["1"],
                'jsfunction'=>'changeStatus',
                'field'=>'status_d',
                'field_value'=>'1'
                ],
        ];
    }

    /**
     * 获得启用的所有微信公众号信息
     * @return array|\yii\db\ActiveRecord[]
     */
    static public function getOnWechats(){
        return self::find()->where(['status_d'=>'1'])->all();
    }

    /**
     * 获取微信实例
     * @param $id
     * @return \EasyWeChat\Foundation\Application
     */
    static public function getApplication($id){
        $wechat = self::find()->where(['id'=>$id])->one();



        $options['app_id'] = $wechat->appID;
        $options['secret'] = $wechat->secret;
        $options['token'] = $wechat->token;
        $options['aes_key'] = $wechat->encoding_aes_key;

        return  new Application($options);

    }
}
