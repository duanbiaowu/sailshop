<?php

namespace common\models\goods;

use Yii;

/**
 * This is the model class for table "{{%book_author}}".
 *
 * @property string $isbn
 * @property integer $author_id
 *
 * @property Book $isbn0
 * @property Author $author
 */
class BookAuthor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%book_author}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['isbn', 'author_id'], 'required'],
            [['author_id'], 'integer'],
            [['isbn'], 'string', 'max' => 13]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'isbn' => 'Isbn',
            'author_id' => 'Author ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIsbn0()
    {
        return $this->hasOne(Book::className(), ['isbn' => 'isbn']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }
}
