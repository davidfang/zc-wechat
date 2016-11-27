<?php
/**
* ErrorLog搜索模型
* Created by David
* User: David.Fang
* Date: 2016-11-21* Time: 19:25:16*/
namespace zc\wechat\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use zc\wechat\models\ErrorLog;

/**
 * ErrorLogSearch represents the model behind the search form about `zc\wechat\models\ErrorLog`.
 */
class ErrorLogSearch extends ErrorLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['ErrCode', 'ErrMsg', 'file', 'line_code', 'created_at'], 'safe'],
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
        $query = ErrorLog::find();

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

        $query->andFilterWhere(['like', 'ErrCode', $this->ErrCode])
            ->andFilterWhere(['like', 'ErrMsg', $this->ErrMsg])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'line_code', $this->line_code]);

        return $dataProvider;
    }
}
