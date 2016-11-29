<?php
/**
* ResponseReply搜索模型
* Created by David
* User: David.Fang
* Date: 2016-11-21* Time: 20:12:15*/
namespace zc\wechat\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use zc\wechat\models\ResponseReply;

/**
 * ResponseReplySearch represents the model behind the search form about `zc\wechat\models\ResponseReply`.
 */
class ResponseReplySearch extends ResponseReply
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','wechat_id', 'priority', 'show_times'], 'integer'],
            [['keyword', 'type', 'title', 'url', 'description', 'img_banner', 'img_icon', 'musicurl', 'hqmusicurl', 'ThumbMediaId', 'voice', 'video', 'img_picture', 'MediaId', 'created_at'], 'safe'],
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
        $query = ResponseReply::find();

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
            'show_times' => $this->show_times,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'keyword', $this->keyword])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'img_banner', $this->img_banner])
            ->andFilterWhere(['like', 'img_icon', $this->img_icon])
            ->andFilterWhere(['like', 'musicurl', $this->musicurl])
            ->andFilterWhere(['like', 'hqmusicurl', $this->hqmusicurl])
            ->andFilterWhere(['like', 'ThumbMediaId', $this->ThumbMediaId])
            ->andFilterWhere(['like', 'voice', $this->voice])
            ->andFilterWhere(['like', 'video', $this->video])
            ->andFilterWhere(['like', 'img_picture', $this->img_picture])
            ->andFilterWhere(['like', 'MediaId', $this->MediaId]);

        return $dataProvider;
    }
}
