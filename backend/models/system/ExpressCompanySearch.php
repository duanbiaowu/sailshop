<?php

namespace backend\models\system;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\system\ExpressCompany;

/**
 * ExpressCompanySearch represents the model behind the search form about `backend\models\system\ExpressCompany`.
 */
class ExpressCompanySearch extends ExpressCompany
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sort', 'available'], 'integer'],
            [['name', 'identifier', 'code', 'url'], 'safe'],
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
        $query = ExpressCompany::find();

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
            'available' => $this->available,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'identifier', $this->identifier])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
}
