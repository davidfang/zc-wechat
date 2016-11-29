<?php
/**
* ResponseKeyword搜索模型
* Created by David
* User: David.Fang
* Date: 2016-11-21* Time: 20:00:49*/
namespace zc\wechat\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use zc\wechat\models\ResponseKeyword;

/**
 * ResponseKeywordSearch represents the model behind the search form about `zc\wechat\models\ResponseKeyword`.
 */
class ResponseKeywordSearch extends ResponseKeyword
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','wechat_id', 'priority', 'times'], 'integer'],
            [['keyword', 'type', 'created_at'], 'safe'],
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
        $query = ResponseKeyword::find();

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
            'priority' => $this->priority,
            'times' => $this->times,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'keyword', $this->keyword])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
