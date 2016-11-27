<?php
/**
* CurlLog搜索模型
* Created by David
* User: David.Fang
* Date: 2016-11-21* Time: 17:22:26*/
namespace zc\wechat\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use zc\wechat\models\CurlLog;

/**
 * CurlLogSearch represents the model behind the search form about `zc\wechat\models\CurlLog`.
 */
class CurlLogSearch extends CurlLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['queryUrl', 'param', 'method', 'is_json', 'is_urlcode', 'ret', 'created_at'], 'safe'],
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
        $query = CurlLog::find();

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
        ]);

        $query->andFilterWhere(['like', 'queryUrl', $this->queryUrl])
            ->andFilterWhere(['like', 'param', $this->param])
            ->andFilterWhere(['like', 'method', $this->method])
            ->andFilterWhere(['like', 'is_json', $this->is_json])
            ->andFilterWhere(['like', 'is_urlcode', $this->is_urlcode])
            ->andFilterWhere(['like', 'ret', $this->ret]);

        return $dataProvider;
    }
}
