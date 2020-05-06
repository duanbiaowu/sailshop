<?php

namespace common\models\content;

use Yii;

/**
 * This is the model class for table "{{%article_content}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $category_id
 * @property string $content
 * @property string $create_time
 *
 * @property ArticleCategory $category
 */
class ArticleContent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_content}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'category_id'], 'required'],
            [['category_id'], 'integer'],
            [['content'], 'string'],
            [['create_time'], 'safe'],
            [['title'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'category_id' => '分类',
            'content' => '内容',
            'create_time' => '发布时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ArticleCategory::className(), ['id' => 'category_id']);
    }
}
