<?php
/**
* ResponseKeyValue搜索模型
* Created by David
* User: David.Fang
* Date: 2016-11-21* Time: 20:04:19*/
namespace zc\wechat\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use zc\wechat\models\ResponseKeyValue;

/**
 * ResponseKeyValueSearch represents the model behind the search form about `zc\wechat\models\ResponseKeyValue`.
 */
class ResponseKeyValueSearch extends ResponseKeyValue
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'keyword_id', 'reply_id'], 'integer'],
            [['created_at'], 'safe'],
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
        $query = ResponseKeyValue::find();

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
            'keyword_id' => $this->keyword_id,
            'reply_id' => $this->reply_id,
            'created_at' => $this->created_at,
        ]);

        return $dataProvider;
    }
}
