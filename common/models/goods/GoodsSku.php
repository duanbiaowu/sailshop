<?php

namespace common\models\goods;

use Yii;

/**
 * This is the model class for table "{{%goods_sku}}".
 *
 * @property integer $id
 * @property integer $goods_id
 * @property string $sku_id
 * @property double $cost_price
 * @property double $market_price
 * @property double $sale_price
 * @property integer $stock
 */
class GoodsSku extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_sku}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'stock'], 'integer'],
            [['sku_id'], 'required'],
            [['cost_price', 'market_price', 'sale_price'], 'number'],
            [['sku_id'], 'string', 'max' => 2048]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('Goods', 'ID'),
            'goods_id' => Yii::t('Goods', 'Goods ID'),
            'sku_id' => Yii::t('Goods', 'Sku ID'),
            'cost_price' => Yii::t('Goods', 'Cost Price'),
            'market_price' => Yii::t('Goods', 'Market Price'),
            'sale_price' => Yii::t('Goods', 'Sale Price'),
            'stock' => Yii::t('Goods', 'Stock'),
        ];
    }

    /**
     * @param \common\models\goods\Goods $goods
     */
    public function skuUpdate($goods)
    {
        $currentSku = self::find()
            ->where(['goods_id' => $goods->id])
            ->indexBy('sku_id')
            ->asArray()
            ->all();

        $costPrice = Yii::$app->request->post('cost_price');
        $marketPrice = Yii::$app->request->post('market_price');
        $salePrice = Yii::$app->request->post('sale_price');
        $stock = Yii::$app->request->post('stock');
        $weight = Yii::$app->request->post('weight');

        foreach ($costPrice as $index => $value) {
            $sku = [
                'goods_id' => $goods->id,
                'sku_id' => $index,
                'cost_price' => $value,
                'market_price' => $marketPrice[$index],
                'sale_price' => $salePrice[$index],
                'stock' => $stock[$index],
                'weight' => $weight[$index],
            ];

            if (isset($currentSku[$index])) {
                Yii::$app->db->createCommand()->update(self::tableName(), $sku, ['id' => $currentSku[$index]['id']])->execute();
                unset($currentSku[$index]);
            } else {
                Yii::$app->db->createCommand()->insert(self::tableName(), $sku)->execute();
            }
        }

        if ($currentSku) {
            foreach ($currentSku as $sku) {
                GoodsSku::findOne($sku['id'])->delete();
            }
        }
    }

    /**
     * @param \common\models\goods\Goods $goods
     * @return array
     */
    public function format($goods)
    {
        $sku = [];
        foreach (self::findAll(['goods_id' => $goods->id]) as $model) {
            $sku['items'][$model->sku_id] = $model->getAttributes();
            foreach (explode('_', $model->sku_id) as $index) {
                $sku['index'][] = $index;
            }
        }
        $sku['index'] = array_unique($sku['index']);
        return $sku;
    }

    public function afterFind()
    {
        $this->cost_price = sprintf('%.2f', $this->cost_price);
        $this->market_price = sprintf('%.2f', $this->market_price);
        $this->sale_price = sprintf('%.2f', $this->sale_price);

        parent::afterFind(); // TODO: Change the autogenerated stub
    }
}
