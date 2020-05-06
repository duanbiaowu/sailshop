<?php

namespace backend\models\system;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\system\UserOperateLog;

/**
 * UserOperateLogSearch represents the model behind the search form about `backend\models\system\UserOperateLog`.
 */
class UserOperateLogSearch extends UserOperateLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['username', 'menu_name', 'permission', 'query', 'create_time'], 'safe'],
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
        $query = UserOperateLog::find();

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
            'user_id' => $this->user_id,
            'create_time' => $this->create_time,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'menu_name', $this->menu_name])
            ->andFilterWhere(['like', 'permission', $this->permission])
            ->andFilterWhere(['like', 'query', $this->query]);

        return $dataProvider;
    }
}
