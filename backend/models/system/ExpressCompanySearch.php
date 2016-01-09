<?php
/**
 * @explain: CangYun3
 * @author: Biaowu Duan
 * @datetime: 2016/1/9-11:13
 */

namespace backend\models\system;

use Yii;
use yii\data\ActiveDataProvider;
use backend\models\system\ExpressCompany;

class ExpressCompanySearch extends ExpressCompany
{
	public function search($params)
	{
		$query = ExpressCompany::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		$this->load($params);

		if (!$this->validate()) {
			return $dataProvider;
		}

		$query->andFilterWhere([
			'name' => ['like', 'name', $this->name],
		]);

		return $dataProvider;

	}
}