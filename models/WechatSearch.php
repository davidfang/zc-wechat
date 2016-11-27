<?php
/**
* Wechat搜索模型
* Created by David
* User: David.Fang
* Date: 2016-11-15* Time: 23:11:29*/
namespace zc\wechat\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use zc\wechat\models\Wechat;

/**
 * WechatSearch represents the model behind the search form about `zc\wechat\models\Wechat`.
 */
class WechatSearch extends Wechat
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'token', 'access_token', 'account', 'original', 'type_d', 'appID', 'secret', 'encoding_aes_key', 'base_url', 'img_avatar', 'img_qrcode', 'address', 'description', 'username', 'status_d', 'password', 'adddate'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Wechat::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => '10',
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'adddate' => $this->adddate,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'token', $this->token])
            ->andFilterWhere(['like', 'access_token', $this->access_token])
            ->andFilterWhere(['like', 'account', $this->account])
            ->andFilterWhere(['like', 'original', $this->original])
            ->andFilterWhere(['like', 'type_d', $this->type_d])
            ->andFilterWhere(['like', 'appID', $this->appID])
            ->andFilterWhere(['like', 'secret', $this->secret])
            ->andFilterWhere(['like', 'encoding_aes_key', $this->encoding_aes_key])
            ->andFilterWhere(['like', 'base_url', $this->base_url])
            ->andFilterWhere(['like', 'img_avatar', $this->img_avatar])
            ->andFilterWhere(['like', 'img_qrcode', $this->img_qrcode])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'status_d', $this->status_d])
            ->andFilterWhere(['like', 'password', $this->password]);

        return $dataProvider;
    }
}
