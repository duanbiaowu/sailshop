<?php

namespace common\models\goods;

use Yii;

/**
 * This is the model class for table "{{%goods_specifications}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property integer $type
 * @property string $items
 * @property integer $available
 */
class Specifications extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_specifications}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'items'], 'required'],
            [['parent_id', 'type', 'available'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['items'], 'string', 'max' => 1024]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('System', 'ID'),
            'name' => Yii::t('System', 'Name'),
            'parent_id' => Yii::t('System', 'Parent ID'),
            'type' => Yii::t('System', 'Type'),
            'items' => Yii::t('System', 'Items'),
            'available' => Yii::t('System', 'Available'),
        ];
    }
}
