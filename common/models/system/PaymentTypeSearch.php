<?php

namespace common\models\system;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\system\PaymentType;

/**
 * PaymentTypeSearch represents the model behind the search form about `common\models\system\PaymentType`.
 */
class PaymentTypeSearch extends PaymentType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sort', 'status'], 'integer'],
            [['name', 'app_key', 'app_secret', 'description'], 'safe'],
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
        $query = PaymentType::find();

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
            'sort' => $this->sort,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'app_key', $this->app_key])
            ->andFilterWhere(['like', 'app_secret', $this->app_secret])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
