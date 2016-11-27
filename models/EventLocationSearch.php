<?php
/**
* EventLocation搜索模型
* Created by David
* User: David.Fang
* Date: 2016-11-21* Time: 19:20:51*/
namespace zc\wechat\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use zc\wechat\models\EventLocation;

/**
 * EventLocationSearch represents the model behind the search form about `zc\wechat\models\EventLocation`.
 */
class EventLocationSearch extends EventLocation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'CreateTime'], 'integer'],
            [['ToUserName', 'FromUserName', 'MsgType', 'Event', 'Latitude', 'Longitude', 'Precision', 'created_at'], 'safe'],
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
        $query = EventLocation::find();

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
            ->andFilterWhere(['like', 'Latitude', $this->Latitude])
            ->andFilterWhere(['like', 'Longitude', $this->Longitude])
            ->andFilterWhere(['like', 'Precision', $this->Precision]);

        return $dataProvider;
    }
}
