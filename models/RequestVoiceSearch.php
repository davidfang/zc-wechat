<?php
/**
* RequestVoice搜索模型
* Created by David
* User: David.Fang
* Date: 2016-11-21* Time: 19:59:29*/
namespace zc\wechat\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use zc\wechat\models\RequestVoice;

/**
 * RequestVoiceSearch represents the model behind the search form about `zc\wechat\models\RequestVoice`.
 */
class RequestVoiceSearch extends RequestVoice
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ToUserName', 'FromUserName', 'MsgType', 'MediaId', 'Format', 'MsgId', 'Recognition', 'created_at'], 'safe'],
            [['CreateTime'], 'integer'],
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
        $query = RequestVoice::find();

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
            'CreateTime' => $this->CreateTime,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'ToUserName', $this->ToUserName])
            ->andFilterWhere(['like', 'FromUserName', $this->FromUserName])
            ->andFilterWhere(['like', 'MsgType', $this->MsgType])
            ->andFilterWhere(['like', 'MediaId', $this->MediaId])
            ->andFilterWhere(['like', 'Format', $this->Format])
            ->andFilterWhere(['like', 'MsgId', $this->MsgId])
            ->andFilterWhere(['like', 'Recognition', $this->Recognition]);

        return $dataProvider;
    }
}
