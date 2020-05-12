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
            [['id', 'type'], 'integer'],
            [['member_id'], 'string'],
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
        $a = MemberAccountRecord::tableName();
        $b = Member::tableName();

        $query = MemberAccountRecord::find()
            ->innerJoin($b, $b .'.id = ' . $a . '.member_id')
            ->select([$a . '.*', $b . '.username']);

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
            'type' => $this->type,
            'value' => $this->value,
//            'create_time' => $this->create_time,
        ]);

        $query->andFilterWhere(['like', 'username', $this->member_id])
            ->andFilterWhere(['like', 'remark', $this->remark]);
        $query->orderBy(['id' => SORT_DESC]);

        return $dataProvider;
    }
}
