<?php
/**
* Scene搜索模型
* Created by David
* User: David.Fang
* Date: 2016-11-29* Time: 14:51:19*/
namespace zc\wechat\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use zc\wechat\models\Scene;

/**
 * SceneSearch represents the model behind the search form about `zc\wechat\models\Scene`.
 */
class SceneSearch extends Scene
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'wechat_id', 'subscribeNumber', 'expireSeconds', 'sceneId', 'created_at', 'updated_at'], 'integer'],
            [['name', 'describtion', 'type', 'Ticket', 'TicketTime', 'isCreated', 'url'], 'safe'],
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
        $query = Scene::find();

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
            'wechat_id' => $this->wechat_id,
            'subscribeNumber' => $this->subscribeNumber,
            'expireSeconds' => $this->expireSeconds,
            'sceneId' => $this->sceneId,
            'TicketTime' => $this->TicketTime,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'describtion', $this->describtion])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'Ticket', $this->Ticket])
            ->andFilterWhere(['like', 'isCreated', $this->isCreated])
            ->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
}
