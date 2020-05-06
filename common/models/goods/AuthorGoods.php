<?php

namespace common\models\goods;

use Yii;

/**
 * This is the model class for table "{{%author_goods}}".
 *
 * @property integer $author_id
 * @property integer $goods_id
 *
 * @property Author $author
 * @property Goods $goods
 */
class AuthorGoods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%author_goods}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id', 'goods_id'], 'required'],
            [['author_id', 'goods_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'author_id' => 'Author ID',
            'goods_id' => 'Goods ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasOne(Goods::className(), ['id' => 'goods_id']);
    }
}
