<?php

namespace common\models\content;

use Yii;

/**
 * This is the model class for table "{{%article_category}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property integer $sort
 *
 * @property ArticleContent[] $articleContents
 */
class ArticleCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'sort'], 'integer'],
            [['parent_id', 'sort'], 'default', 'value' => 0, 'on' => ['default']],
            [['name'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'parent_id' => '父级分类',
            'sort' => '排序值',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleContents()
    {
        return $this->hasMany(ArticleContent::className(), ['category_id' => 'id']);
    }

    /**
     * @return array
     */
    public static function getAllCategories()
    {
        return ArticleCategory::find()
            ->orderBy(['sort' => SORT_DESC])
            ->indexBy('id')
            ->asArray()
            ->all();
    }
}
