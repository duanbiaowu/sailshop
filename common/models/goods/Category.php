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
            'id' => Yii::t('System', 'ID'),
            'name' => Yii::t('System', 'Name'),
            'parent_id' => Yii::t('System', 'Parent ID'),
            'type_id' => Yii::t('System', 'Type ID'),
            'path' => Yii::t('System', 'Path'),
            'sort' => Yii::t('System', 'Sort'),
            'seo_title' => Yii::t('System', 'Seo Title'),
            'set_keyword' => Yii::t('System', 'Set Keyword'),
            'seo_description' => Yii::t('System', 'Seo Description'),
        ];
    }
}
