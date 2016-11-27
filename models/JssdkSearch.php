<?php
/**
* Jssdk搜索模型
* Created by David
* User: David.Fang
* Date: 2016-11-21* Time: 19:34:06*/
namespace zc\wechat\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use zc\wechat\models\Jssdk;

/**
 * JssdkSearch represents the model behind the search form about `zc\wechat\models\Jssdk`.
 */
class JssdkSearch extends Jssdk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ErrCode', 'expire_time'], 'integer'],
            [['ErrMsg', 'JsApiTicket', 'created_at'], 'safe'],
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
        $query = Jssdk::find();

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
            'ErrCode' => $this->ErrCode,
            'expire_time' => $this->expire_time,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'ErrMsg', $this->ErrMsg])
            ->andFilterWhere(['like', 'JsApiTicket', $this->JsApiTicket]);

        return $dataProvider;
    }
}
