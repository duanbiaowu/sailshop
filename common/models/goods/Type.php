<?php

namespace common\models\goods;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%goods_type}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $attributes
 * @property string $specifications
 * @property string $brands
 */
class Type extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['attributes', 'specifications', 'brands'], 'string'],
            [['name'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('Goods', 'ID'),
            'name' => Yii::t('Goods', 'name'),
        ];
    }
}
