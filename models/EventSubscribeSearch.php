<?php
/**
* EventSubscribe搜索模型
* Created by David
* User: David.Fang
* Date: 2016-11-25* Time: 18:53:50*/
namespace zc\wechat\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use zc\wechat\models\EventSubscribe;

/**
 * EventSubscribeSearch represents the model behind the search form about `zc\wechat\models\EventSubscribe`.
 */
class EventSubscribeSearch extends EventSubscribe
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'CreateTime'], 'integer'],
            [['ToUserName', 'FromUserName', 'MsgType', 'Event', 'EventKey', 'Ticket', 'created_at'], 'safe'],
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
        $query = EventSubscribe::find();

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
            'CreateTime' => $this->CreateTime,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'ToUserName', $this->ToUserName])
            ->andFilterWhere(['like', 'FromUserName', $this->FromUserName])
            ->andFilterWhere(['like', 'MsgType', $this->MsgType])
            ->andFilterWhere(['like', 'Event', $this->Event])
            ->andFilterWhere(['like', 'EventKey', $this->EventKey])
            ->andFilterWhere(['like', 'Ticket', $this->Ticket]);

        return $dataProvider;
    }
}
