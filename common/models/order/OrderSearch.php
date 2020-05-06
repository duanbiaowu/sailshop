<?php

namespace common\models\order;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\order\Order;

/**
 * OrderSearch represents the model behind the search form about `common\models\order\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'member_id', 'status', 'pay_type', 'express_type', 'province_id', 'city_id', 'district_id'], 'integer'],
            [['price_count'], 'number'],
            [['finish_time', 'pay_time', 'express_code', 'remark', 'name', 'mobile', 'province_name', 'city_name', 'district_name', 'zip_code', 'detail_address', 'create_time'], 'safe'],
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
        $query = Order::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'member_id' => $this->member_id,
            'price_count' => $this->price_count,
            'status' => $this->status,
            'finish_time' => $this->finish_time,
            'pay_type' => $this->pay_type,
            'pay_time' => $this->pay_time,
            'express_type' => $this->express_type,
            'province_id' => $this->province_id,
            'city_id' => $this->city_id,
            'district_id' => $this->district_id,
            'create_time' => $this->create_time,
        ]);

        $query->andFilterWhere(['like', 'express_code', $this->express_code])
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'province_name', $this->province_name])
            ->andFilterWhere(['like', 'city_name', $this->city_name])
            ->andFilterWhere(['like', 'district_name', $this->district_name])
            ->andFilterWhere(['like', 'zip_code', $this->zip_code])
            ->andFilterWhere(['like', 'detail_address', $this->detail_address]);

        return $dataProvider;
    }
}
