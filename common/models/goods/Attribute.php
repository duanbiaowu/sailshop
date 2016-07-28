<?php

namespace common\models\goods;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%goods_attribute}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property integer $type
 * @property string $items
 * @property integer $available
 */
class Attribute extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_attribute}}';
    }

    public function scenarios()
    {
        return [
            'multiple' => ['name', 'parent_id', 'type', 'items'],
            'default' => ['name', 'parent_id', 'type']
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            ['parent_id', 'in', 'range' => array_keys($this->groups()), 'allowArray' => true],
            ['type', 'in', 'range' => array_keys($this->formTags()), 'allowArray' => true],
            [['name'], 'string', 'max' => 64],
            [['items'], 'string', 'max' => 1024],
            [['items'], 'required', 'on' => 'multiple'],
//            ['available', 'boolean', 'strict' => true],
//            ['available', 'default', 'value' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('Goods', 'ID'),
            'name' => Yii::t('Goods', 'attribute_name'),
            'parent_id' => Yii::t('Goods', 'attribute_parent_id'),
            'type' => Yii::t('Goods', 'attribute_type'),
            'items' => Yii::t('Goods', 'attribute_items'),
            'available' => Yii::t('Goods', 'attribute_available'),
        ];
    }

    public function formTags()
    {
        return [
            Yii::t('Goods', 'attribute_form_text'),
            Yii::t('Goods', 'attribute_form_text_area'),
            Yii::t('Goods', 'attribute_form_checkbox'),
            Yii::t('Goods', 'attribute_form_drop_list'),
        ];
    }

    public function groups()
    {
        $groups = Attribute::find()
            ->where(['parent_id' => 0])
            ->indexBy('id')
            ->asArray()
            ->all();

        foreach ($groups as $value) {
            $groups[$value['id']] = $value['name'];
        }

        return [Yii::t('Goods', 'attribute_form_prompt')] + $groups;
    }

    public function afterValidate()
    {
        $attribute = Yii::$app->request->post('Attribute');
        if ($this->parent_id && isset($attribute['items'])) {
            $items = [];
            foreach ($attribute['items'] as $item) {
                $items[] = ['value' => $item];
            }
            $this->items = serialize($items);
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
