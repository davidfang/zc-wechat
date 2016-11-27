<?php
/**
* RequestLog搜索模型
* Created by David
* User: David.Fang
* Date: 2016-11-21* Time: 19:55:59*/
namespace zc\wechat\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use zc\wechat\models\RequestLog;

/**
 * RequestLogSearch represents the model behind the search form about `zc\wechat\models\RequestLog`.
 */
class RequestLogSearch extends RequestLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'speed'], 'integer'],
            [['get', 'post', 'created_at'], 'safe'],
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
        $query = RequestLog::find();

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
            'speed' => $this->speed,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'get', $this->get])
            ->andFilterWhere(['like', 'post', $this->post]);

        return $dataProvider;
    }
}
