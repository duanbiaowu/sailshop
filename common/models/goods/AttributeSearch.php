<?php

namespace common\models\goods;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\goods\Attribute;

/**
 * AttributeSearch represents the model behind the search form about `common\models\goods\Attribute`.
 */
class AttributeSearch extends Attribute
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'type', 'available'], 'integer'],
            [['name', 'items'], 'safe'],
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
        $query = Attribute::find();

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
            'parent_id' => $this->parent_id,
            'type' => $this->type,
            'available' => $this->available,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'items', $this->items]);

        return $dataProvider;
    }
}
