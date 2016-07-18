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
            [['name'], 'required'],
            [['parent_id', 'type'], 'integer'],
            ['type', 'boolean', 'strict' => true],
            [['name'], 'string', 'max' => 64],
            [['items'], 'string', 'max' => 1024],
            ['parent_id', 'in', 'range' => array_keys($this->specGroup()), 'allowArray' => true]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('Goods', 'Specifications Name'),
            'parent_id' => Yii::t('Goods', 'Specifications Parent ID'),
            'type' => Yii::t('Goods', 'Specifications Type'),
            'items' => Yii::t('Goods', 'Specifications Items'),
            'available' => Yii::t('Goods', 'Specifications Available'),
        ];
    }

    public static function specTypes()
    {
        return [
            0 => Yii::t('Goods', 'Specifications Text'),
            1 => Yii::t('Goods', 'Specifications Image'),
        ];
    }

    public static function specGroup()
    {
        $groups = self::find()
            ->select(['id', 'name'])
            ->where(['parent_id' => 0])
            ->asArray()
            ->all();

        $result = [
            0 => Yii::t('Goods', 'Specifications Highest Group'),
        ];
        foreach ($groups as $group) {
            $result[$group['id']] = $group['name'];
        }
        return $result;
    }


    public function beforeValidate()
    {
        $specs = Yii::$app->request->post('Specifications');
        if ($this->parent_id) {
            $this->items = serialize([
                'values' => $specs['values'],
                'images' => $specs['images'],
            ]);
        } else {
            $this->items = '';
        }
        return parent::beforeValidate();
    }

    public function afterFind()
    {
        $this->items = unserialize($this->items);
    }

}
