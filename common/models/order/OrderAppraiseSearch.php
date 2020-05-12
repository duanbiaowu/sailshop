<?php

namespace common\models\order;

use common\models\goods\Book;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\order\OrderAppraise;

/**
 * OrderAppraiseSearch represents the model behind the search form about `common\models\order\OrderAppraise`.
 */
class OrderAppraiseSearch extends OrderAppraise
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_id'], 'integer'],
            [['isbn', 'content', 'create_time'], 'safe'],
            [['score'], 'number'],
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
        $a = OrderAppraise::tableName();
        $b = Book::tableName();

        $query = OrderAppraise::find()
            ->innerJoin($b, $a . '.isbn = ' . $b . '.isbn');

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
            'score' => $this->score,
            'create_time' => $this->create_time,
        ]);

        $query->andFilterWhere(['like', 'name', $this->isbn])
            ->andFilterWhere(['like', 'content', $this->content])
            ->orderBy(['id' => SORT_DESC]);

        return $dataProvider;
    }
}
