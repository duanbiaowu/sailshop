<?php

namespace common\models\goods;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\goods\Type;

/**
 * TypeSearch represents the model behind the search form about `common\models\goods\Type`.
 */
class TypeSearch extends Type
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'attributes', 'specifications', 'brands'], 'safe'],
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
        $query = Type::find();

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
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'attributes', $this->attributes])
            ->andFilterWhere(['like', 'specifications', $this->specifications])
            ->andFilterWhere(['like', 'brands', $this->brands]);

        return $dataProvider;
    }
}
