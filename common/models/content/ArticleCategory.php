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
            'name' => 'Name',
            'parent_id' => 'Parent ID',
            'sort' => 'Sort',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleContents()
    {
        return $this->hasMany(ArticleContent::className(), ['category_id' => 'id']);
    }
}
