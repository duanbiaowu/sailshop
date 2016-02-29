<?php

namespace common\models\goods;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%goods_category}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property integer $type_id
 * @property string $path
 * @property integer $sort
 * @property string $seo_title
 * @property string $set_keyword
 * @property string $seo_description
 */
class Category extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'seo_title', 'set_keyword', 'seo_description'], 'required'],
            [['parent_id', 'type_id', 'sort'], 'integer'],
            [['name', 'seo_description'], 'string', 'max' => 255],
            [['path'], 'string', 'max' => 2048],
            [['seo_title'], 'string', 'max' => 64],
            [['set_keyword'], 'string', 'max' => 128]
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
            'parent_id' => Yii::t('Goods', 'parent_id'),
            'type_id' => Yii::t('Goods', 'type_id'),
            'path' => Yii::t('Goods', 'path'),
            'sort' => Yii::t('Goods', 'sort'),
            'seo_title' => Yii::t('Goods', 'seo_title'),
            'set_keyword' => Yii::t('Goods', 'set_keyword'),
            'seo_description' => Yii::t('Goods', 'seo_description'),
        ];
    }
}
