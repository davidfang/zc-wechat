<?php

namespace zc\wechat\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * "wx_user"表的model
 *
 * @property string $openid
 * @property integer $subscribe
 * @property string $nickname
 * @property integer $sex
 * @property string $city
 * @property string $country
 * @property string $province
 * @property string $language
 * @property string $headimgurl
 * @property integer $subscribe_time
 * @property string $unionid
 * @property string $remark
 * @property string $privilege
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Article[] $articles
 * @property UserProfile $userProfile
 */
class User extends \yii\db\ActiveRecord
{
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['openid'], 'required'],
            [['subscribe', 'sex', 'subscribe_time', 'created_at', 'updated_at'], 'integer'],
            [['openid', 'nickname', 'headimgurl', 'unionid'], 'string', 'max' => 255],
            [['city', 'country', 'province'], 'string', 'max' => 20],
            [['language'], 'string', 'max' => 10],
            [['remark'], 'string', 'max' => 60],
            [['privilege'], 'string', 'max' => 1000]
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
            'openid',// '用户的标识，对当前公众号唯一',
            'subscribe',// '用户是否订阅该公众号标识，值为0时，代表此用户没有关注该公众号，拉取不到其余信息。',
            'nickname',// '用户的昵称',
            'sex',// '用户的性别，值为1时是男性，值为2时是女性，值为0时是未知',
            'city',// '用户所在城市',
            'country',// '用户所在国家',
            'province',// '用户所在省份',
            'language',// '用户的语言，简体中文为zh_CN',
            'headimgurl',// '用户头像，最后一个数值代表正方形头像大小（有0、46、64、96、132数值可选，0代表640*640正方形头像），用户没有头像时该项为空。若用户更换头像，原有头像URL将失效。',
            'subscribe_time',// '用户关注时间，为时间戳。如果用户曾多次关注，则取最后关注时间',
            'unionid',// '只有在用户将公众号绑定到微信开放平台帐号后，才会出现该字段。详见：获取用户个人信息（UnionID机制）',
            'remark',// '新的备注名，长度必须小于30字符',
            'privilege',// '用户特权信息，json 数组，如微信沃卡用户为（chinaunicom）',
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
            'openid' => '用户的标识，对当前公众号唯一',
            'subscribe' => '用户是否订阅该公众号标识，值为0时，代表此用户没有关注该公众号，拉取不到其余信息。',
            'nickname' => '用户的昵称',
            'sex' => '用户的性别，值为1时是男性，值为2时是女性，值为0时是未知',
            'city' => '用户所在城市',
            'country' => '用户所在国家',
            'province' => '用户所在省份',
            'language' => '用户的语言，简体中文为zh_CN',
            'headimgurl' => '用户头像，最后一个数值代表正方形头像大小（有0、46、64、96、132数值可选，0代表640*640正方形头像），用户没有头像时该项为空。若用户更换头像，原有头像URL将失效。',
            'subscribe_time' => '用户关注时间，为时间戳。如果用户曾多次关注，则取最后关注时间',
            'unionid' => '只有在用户将公众号绑定到微信开放平台帐号后，才会出现该字段。详见：获取用户个人信息（UnionID机制）',
            'remark' => '新的备注名，长度必须小于30字符',
            'privilege' => '用户特权信息，json 数组，如微信沃卡用户为（chinaunicom）',
            'created_at' => '建立时间',
            'updated_at' => '更新时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfile()
    {
        return $this->hasOne(UserProfile::className(), ['user_id' => 'id']);
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
