<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MemberAccountRecord;

/**
 * AccountRecordSearch represents the model behind the search form about `common\models\MemberAccountRecord`.
 */
class AccountRecordSearch extends MemberAccountRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'member_id', 'type'], 'integer'],
            [['value'], 'number'],
            [['remark', 'create_time'], 'safe'],
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
        $query = MemberAccountRecord::find();

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
            'type' => $this->type,
            'value' => $this->value,
            'create_time' => $this->create_time,
        ]);

        $query->andFilterWhere(['like', 'remark', $this->remark]);
        $query->orderBy(['id' => SORT_DESC]);

        return $dataProvider;
    }
}
