<?php

namespace common\models\goods;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\goods\Book;

/**
 * BookSearch represents the model behind the search form about `common\models\goods\Book`.
 */
class BookSearch extends Book
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['isbn', 'name', 'thumbnail', 'show_pictures', 'translator', 'binding', 'publish_date', 'introduce', 'modified_time', 'create_time'], 'safe'],
            [['category_id', 'brand_id', 'pages', 'weight', 'stock', 'status'], 'integer'],
            [['price'], 'number'],
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
        $query = Book::find();

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
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'pages' => $this->pages,
            'weight' => $this->weight,
            'publish_date' => $this->publish_date,
            'price' => $this->price,
            'stock' => $this->stock,
            'status' => $this->status,
            'modified_time' => $this->modified_time,
            'create_time' => $this->create_time,
        ]);

        $query->andFilterWhere(['like', 'isbn', $this->isbn])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'thumbnail', $this->thumbnail])
            ->andFilterWhere(['like', 'show_pictures', $this->show_pictures])
            ->andFilterWhere(['like', 'translator', $this->translator])
            ->andFilterWhere(['like', 'binding', $this->binding])
            ->andFilterWhere(['like', 'introduce', $this->introduce])
            ->orderBy(['create_time' => SORT_DESC]);

        return $dataProvider;
    }
}
