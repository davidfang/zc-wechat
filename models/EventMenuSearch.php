<?php
/**
* EventMenu搜索模型
* Created by David
* User: David.Fang
* Date: 2016-11-25* Time: 19:05:28*/
namespace zc\wechat\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use zc\wechat\models\EventMenu;

/**
 * EventMenuSearch represents the model behind the search form about `zc\wechat\models\EventMenu`.
 */
class EventMenuSearch extends EventMenu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'CreateTime', 'Count'], 'integer'],
            [['ToUserName', 'FromUserName', 'MsgType', 'Event', 'EventKey', 'MenuID', 'ScanCodeInfo', 'ScanType', 'ScanResult', 'SendPicsInfo', 'PicList', 'PicMd5Sum', 'SendLocationInfo', 'Location_X', 'Location_Y', 'Scale', 'Label', 'PoiName', 'created_at'], 'safe'],
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
        $query = EventMenu::find();

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
            'Count' => $this->Count,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'ToUserName', $this->ToUserName])
            ->andFilterWhere(['like', 'FromUserName', $this->FromUserName])
            ->andFilterWhere(['like', 'MsgType', $this->MsgType])
            ->andFilterWhere(['like', 'Event', $this->Event])
            ->andFilterWhere(['like', 'EventKey', $this->EventKey])
            ->andFilterWhere(['like', 'MenuID', $this->MenuID])
            ->andFilterWhere(['like', 'ScanCodeInfo', $this->ScanCodeInfo])
            ->andFilterWhere(['like', 'ScanType', $this->ScanType])
            ->andFilterWhere(['like', 'ScanResult', $this->ScanResult])
            ->andFilterWhere(['like', 'SendPicsInfo', $this->SendPicsInfo])
            ->andFilterWhere(['like', 'PicList', $this->PicList])
            ->andFilterWhere(['like', 'PicMd5Sum', $this->PicMd5Sum])
            ->andFilterWhere(['like', 'SendLocationInfo', $this->SendLocationInfo])
            ->andFilterWhere(['like', 'Location_X', $this->Location_X])
            ->andFilterWhere(['like', 'Location_Y', $this->Location_Y])
            ->andFilterWhere(['like', 'Scale', $this->Scale])
            ->andFilterWhere(['like', 'Label', $this->Label])
            ->andFilterWhere(['like', 'PoiName', $this->PoiName]);

        return $dataProvider;
    }
}
