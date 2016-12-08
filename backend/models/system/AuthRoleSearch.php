<?php

namespace backend\models\system;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\system\AuthRole;

/**
 * AuthRoleSearch represents the model behind the search form about `backend\models\system\AuthRole`.
 */
class AuthRoleSearch extends AuthRole
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'operation'], 'integer'],
            [['name', 'route'], 'safe'],
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
        $query = AuthRole::find()->where(['parent_id' => 0]);

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
            'operation' => $this->operation,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'route', $this->route]);

        return $dataProvider;
    }
}
